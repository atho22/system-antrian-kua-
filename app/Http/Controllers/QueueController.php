<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;
use App\Models\Service;
use Carbon\Carbon;

class QueueController extends Controller
{
    public function index()
    {
        $today = Carbon::now('Asia/Makassar')->startOfDay();
        
        // Get all services
        $services = Service::all();
        
        // Get today's queues
        $queues = Queue::with(['guest', 'service'])
            ->whereDate('created_at', $today)
            ->get();

        return view('queue.index', compact('services', 'queues'));
    }

    public function history(Request $request)
    {
        $query = Queue::with(['guest', 'service']);

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->service_id) {
            $query->where('service_id', $request->service_id);
        }

        $queues = $query->orderBy('created_at', 'desc')->paginate(50);
        $services = Service::all();

        return view('queue.history', compact('queues', 'services'));
    }

    public function export(Request $request)
    {
        // Export logic here
    }
} 