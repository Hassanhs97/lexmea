<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'age',
    ];

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
}
