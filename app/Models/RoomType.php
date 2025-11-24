<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'max_occupancy',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}


