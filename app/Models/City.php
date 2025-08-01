<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $fillable = ['image', 'name', 'slug'];

    public function boardingHouses()
    {
        return $this->hasMany(BoardingHouse::class);
    }   
}
