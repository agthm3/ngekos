<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class RoomImage extends Model
{
    protected $fillable = [
        'room_id',
        'image', // Path to the image file
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
