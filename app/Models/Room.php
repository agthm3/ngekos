<?php

namespace App\Models;
use App\Models\BoardingHouse;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'boarding_house_id',
        'name',
        'room_type',
        'square_feet',
        'price_per_month',
        'is_available',
        'capacity',
    ];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
