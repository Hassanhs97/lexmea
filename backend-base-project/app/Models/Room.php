<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'floor_number',
        'room_number',
        'capacity',
        'status',
        'guest_id'
    ];

    const READY_STATUS       = 'READY';
    const TAKEN_STATUS       = 'TAKEN';
    const MAINTENANCE_STATUS = 'MAINTENANCE';

    public function getCreatedAtAttribute()
    {
        if (isset($this->attributes['created_at'])) {
            return  Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAtAttribute()
    {
        if (isset($this->attributes['created_at'])) {
            return  Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function guest() {
        return $this->belongsTo(Guest::class);
    }
}
