<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Queue;
use App\Models\Service;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function create()
    {
        $services = Service::all();
        return view('guest.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable|string|max:15',
            'service_id' => 'required|exists:services,id',
            'photo' => 'required|string',
        ]);

        // Process base64 image
        $image_parts = explode(";base64,", $request->photo);
        $image_base64 = base64_decode($image_parts[1] ?? $request->photo);
        $fileName = 'photo_' . time() . '_' . Str::random(10) . '.jpg';
        Storage::disk('public')->put('photos/' . $fileName, $image_base64);

        // Simpan tamu
        $guest = Guest::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'photo' => 'photos/' . $fileName,
        ]);

        // Ambil nomor antrian terakhir untuk layanan ini (hari ini)
        $today = Carbon::now('Asia/Makassar')->startOfDay();
        $lastQueue = Queue::where('service_id', $request->service_id)
            ->whereDate('created_at', $today)
            ->orderByDesc('queue_number')
            ->first();
        $queueNumber = $lastQueue ? $lastQueue->queue_number + 1 : 1;

        // Estimasi waktu (15 menit per orang)
        $lastScheduled = Queue::where('service_id', $request->service_id)
            ->whereDate('created_at', $today)
            ->orderByDesc('scheduled_at')
            ->first();
        
        // Pastikan scheduled_at adalah Carbon instance dengan timezone WITA
        $now = Carbon::now('Asia/Makassar');
        $scheduledAt = $lastScheduled 
            ? Carbon::parse($lastScheduled->scheduled_at)->timezone('Asia/Makassar')->addMinutes(15)
            : $now;

        // Jika waktu yang dihasilkan sudah lewat dari waktu sekarang, gunakan waktu sekarang
        if ($scheduledAt->isPast()) {
            $scheduledAt = $now;
        }

        // Simpan antrian
        $queue = Queue::create([
            'guest_id' => $guest->id,
            'service_id' => $request->service_id,
            'queue_number' => $queueNumber,
            'scheduled_at' => $scheduledAt,
            'status' => 'waiting',
        ]);

        // Log aktivitas
        ActivityLog::create([
            'action' => 'create',
            'table_name' => 'queues',
            'description' => "Tamu {$guest->name} mengambil antrian {$queue->service->code}-{$queueNumber} untuk layanan {$queue->service->name}",
            'data' => [
                'guest_id' => $guest->id,
                'queue_id' => $queue->id,
                'service_id' => $request->service_id
            ],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('guest.show', $queue->id);
    }

    public function show($id)
    {
        $queue = Queue::with(['guest', 'service'])->findOrFail($id);
        return view('guest.show', compact('queue'));
    }
} 