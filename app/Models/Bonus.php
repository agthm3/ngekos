<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BoardingHouse;

class Bonus extends Model
{
    protected $fillable = [
        'boarding_house_id',
        'image',
        'name',
        'description',
    ];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}
