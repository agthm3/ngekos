<?php 

namespace App\Repositories;

use App\Interface\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface{
    public function getAllCities()
    {
        // Logic to retrieve all cities from the database
        return \App\Models\City::all();
    }
}