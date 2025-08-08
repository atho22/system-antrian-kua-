<?php
namespace App\Exports;

use App\Models\Queue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class QueueExport implements FromCollection, WithHeadings, WithMapping
{
    protected $queues;

    public function __construct($queues)
    {
        $this->queues = $queues;
    }

    public function collection()
    {
        return $this->queues;
    }

    public function headings(): array
    {
        return [
            'No Antrian',
            'Nama',
            'Layanan',
            'Status',
            'Estimasi Waktu',
            'Tanggal Dibuat',
        ];
    }

    public function map($queue): array
    {
        return [
            $queue->service->code . '-' . str_pad($queue->queue_number, 3, '0', STR_PAD_LEFT),
            $queue->guest->name,
            $queue->service->name,
            ucfirst($queue->status),
            date('H:i', strtotime($queue->scheduled_at)),
            date('d/m/Y H:i', strtotime($queue->created_at)),
        ];
    }
} 