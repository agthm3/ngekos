<?php 

namespace App\Repositories;

use App\Interface\BoardingHouseRepositoryInterface;
use App\Models\BoardingHouse;

class BoardingHouseRepository implements BoardingHouseRepositoryInterface{
    public function getAllBoardingHouses($search = null, $city = null, $category = null)
    {
        $query = BoardingHouse::query();

        if($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if($city) {
            $query->whereHas('city', function($q) use ($city) {
                $q->where('slug', $city);
            });
        }

        if($category) {
            $query->whereHas('category', function($q) use ($category) {
                $q->where('slug', $category);
            });
        }

        return $query->get();
    }

    public function getPopularBoardingHouses($limit = 5)
    {
        return BoardingHouse::withCount('transactions')->orderBy('transactions_count', 'desc')->limit($limit)->get();
    }

    public function getBoardingHouseByCategorySlug($slug)
    {
        return BoardingHouse::whereHas('category', function($query) use ($slug) {
            $query->where('slug', $slug);
        })->get();
    }


    public function getBoardingHouseByCitySlug($slug)
    {
        return BoardingHouse::whereHas('city', function($query) use ($slug) {
            $query->where('slug', $slug);
        })->get();
    }

    public function getBoardingHouseBySlug($slug)
    {
        return BoardingHouse::where('slug', $slug)->first();
    }   
}