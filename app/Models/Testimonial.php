<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BoardingHouse;

class Testimonial extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $fillable = [
        'boarding_house_id',
        'photo', // Path to the testimonial photo
        'content', // Content of the testimonial
        'rating' // Rating given in the testimonial
    ];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class);
    }
}
