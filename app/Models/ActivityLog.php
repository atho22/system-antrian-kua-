<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $fillable = ['action', 'table_name', 'description', 'data', 'ip_address', 'user_agent'];
    protected $casts = ['data' => 'array'];
} 