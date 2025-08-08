<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;
use App\Models\Guest;
use App\Models\Service;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\QueueExport;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistik hari ini
        $today = Carbon::now('Asia/Makassar')->startOfDay();
        $todayQueues = Queue::whereDate('created_at', $today)->count();
        $todayServed = Queue::whereDate('created_at', $today)->where('status', 'served')->count();
        $todayWaiting = Queue::whereDate('created_at', $today)->where('status', 'waiting')->count();
        
        // Statistik per layanan hari ini
        $serviceStats = Queue::with('service')
            ->whereDate('created_at', $today)
            ->select('service_id', DB::raw('count(*) as total'))
            ->groupBy('service_id')
            ->get();
            
        // Antrian terbaru
        $recentQueues = Queue::with(['guest', 'service'])
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
            
        // Cek recall status untuk setiap antrian
        foreach ($recentQueues as $queue) {
            $queue->can_recall = $this->canRecallQueue($queue);
        }
            
        return view('admin.dashboard', compact('todayQueues', 'todayServed', 'todayWaiting', 'serviceStats', 'recentQueues'));
    }

    public function logs(Request $request)
    {
        $logs = ActivityLog::orderBy('created_at', 'desc')
            ->when($request->action, function($q, $action) {
                $q->where('action', $action);
            })
            ->when($request->table_name, function($q, $table) {
                $q->where('table_name', $table);
            })
            ->when($request->date, function($q, $date) {
                $q->whereDate('created_at', Carbon::parse($date, 'Asia/Makassar'));
            })
            ->paginate(50);
            
        return view('admin.logs', compact('logs'));
    }

    public function export(Request $request)
    {
        $period = $request->get('period', 'day');
        $date = $request->get('date', Carbon::now('Asia/Makassar')->toDateString());
        $serviceId = $request->get('service_id');
        
        $query = Queue::with(['guest', 'service']);
        
        if ($period === 'day') {
            $query->whereDate('created_at', $date);
        } elseif ($period === 'month') {
            $query->whereMonth('created_at', Carbon::parse($date, 'Asia/Makassar')->month)
                  ->whereYear('created_at', Carbon::parse($date, 'Asia/Makassar')->year);
        } elseif ($period === 'year') {
            $query->whereYear('created_at', Carbon::parse($date, 'Asia/Makassar')->year);
        }
        
        if ($serviceId) {
            $query->where('service_id', $serviceId);
        }
        
        $queues = $query->orderBy('created_at', 'desc')->get();
        
        // Log aktivitas export
        ActivityLog::create([
            'action' => 'export',
            'table_name' => 'queues',
            'description' => "Export laporan antrian periode $period tanggal $date",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        
        // Export ke Excel
        $filename = "laporan_antrian_{$period}_{$date}.xlsx";
        return Excel::download(new QueueExport($queues), $filename);
    }

    public function updateQueueStatus(Request $request, $id)
    {
        $queue = Queue::findOrFail($id);
        $oldStatus = $queue->status;
        
        if ($request->status === 'skipped') {
            // Increment skipped_count saat status diubah ke skipped
            $queue->update([
                'status' => $request->status,
                'skipped_count' => $queue->skipped_count + 1
            ]);
        } else {
            $queue->update(['status' => $request->status]);
        }
        
        // Log aktivitas
        ActivityLog::create([
            'action' => 'update',
            'table_name' => 'queues',
            'description' => "Update status antrian {$queue->service->code}-{$queue->queue_number} dari $oldStatus ke {$request->status}",
            'data' => ['queue_id' => $id, 'old_status' => $oldStatus, 'new_status' => $request->status],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        
        return redirect()->back()->with('success', 'Status antrian berhasil diupdate');
    }

    public function recallQueue(Request $request, $id)
    {
        $queue = Queue::findOrFail($id);
        
        // Cek apakah 2 antrian berikutnya sudah served
        $nextQueues = Queue::where('service_id', $queue->service_id)
            ->whereDate('created_at', Carbon::now('Asia/Makassar')->startOfDay())
            ->where('queue_number', '>', $queue->queue_number)
            ->where('status', 'served')
            ->orderBy('queue_number')
            ->limit(2)
            ->get();
        
        if ($nextQueues->count() >= 2) {
            $queue->update(['status' => 'waiting']);
            
            // Log aktivitas
            ActivityLog::create([
                'action' => 'recall',
                'table_name' => 'queues',
                'description' => "Panggil ulang antrian {$queue->service->code}-{$queue->queue_number} setelah 2 antrian berikutnya served",
                'data' => ['queue_id' => $id, 'status' => 'waiting'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            
            return redirect()->back()->with('success', 'Antrian berhasil dipanggil ulang');
        }
        
        return redirect()->back()->with('error', 'Belum bisa dipanggil ulang. Harus menunggu 2 antrian berikutnya selesai.');
    }

    private function canRecallQueue($queue)
    {
        // Cek apakah 2 antrian berikutnya sudah served
        $nextQueues = Queue::where('service_id', $queue->service_id)
            ->whereDate('created_at', Carbon::now('Asia/Makassar')->startOfDay())
            ->where('queue_number', '>', $queue->queue_number)
            ->where('status', 'served')
            ->orderBy('queue_number')
            ->limit(2)
            ->get();
        
        return $nextQueues->count() >= 2;
    }
} 