<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BoardingHouse;

class Bonus extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
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
