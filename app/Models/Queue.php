<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Queue extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'guest_id', 
        'service_id', 
        'queue_number', 
        'scheduled_at', 
        'status', 
        'skipped_count'
    ];
    
    protected $casts = [
        'scheduled_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'skipped_count' => 'integer'
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getFormattedScheduleAttribute()
    {
        try {
            $time = Carbon::parse($this->scheduled_at)->timezone('Asia/Makassar')->format('H:i');
            $endTime = Carbon::parse($this->scheduled_at)->timezone('Asia/Makassar')->addMinutes(15)->format('H:i');
            return "$time - $endTime";
        } catch (\Exception $e) {
            return '--:-- - --:--';
        }
    }

    public function getFormattedDateAttribute()
    {
        try {
            return Carbon::parse($this->scheduled_at)
                ->timezone('Asia/Makassar')
                ->translatedFormat('d/m/Y');
        } catch (\Exception $e) {
            return '--/--/----';
        }
    }

    public function getFormattedTimeAttribute()
    {
        try {
            return Carbon::parse($this->scheduled_at)
                ->timezone('Asia/Makassar')
                ->format('H:i');
        } catch (\Exception $e) {
            return '--:--';
        }
    }

    public function getFormattedDateTimeAttribute()
    {
        try {
            return Carbon::parse($this->scheduled_at)
                ->timezone('Asia/Makassar')
                ->translatedFormat('d/m/Y H:i');
        } catch (\Exception $e) {
            return '--/--/---- --:--';
        }
    }

    public function getIsLateAttribute()
    {
        try {
            return Carbon::parse($this->scheduled_at)->timezone('Asia/Makassar')->isPast();
        } catch (\Exception $e) {
            return false;
        }
    }
} 