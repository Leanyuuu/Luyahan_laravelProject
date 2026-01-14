<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'room_number',
        'floor',
        'status',
        'room_type_id',
        'photo_path',
    ];

    protected $appends = [
        'photo_url',
        'initials',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo_path
            ? Storage::disk('public')->url($this->photo_path)
            : null;
    }

    public function getInitialsAttribute(): string
    {
        $roomNumber = (string) $this->room_number;

        return strtoupper(substr($roomNumber, 0, 2));
    }
}


