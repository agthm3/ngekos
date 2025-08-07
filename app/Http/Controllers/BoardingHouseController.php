<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interface\CategoryRepositoryInterface;
use App\Interface\CityRepositoryInterface;
use App\Interface\BoardingHouseRepositoryInterface;

class BoardingHouseController extends Controller
{

    private CityRepositoryInterface $cityRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private BoardingHouseRepositoryInterface $boardingHouseRepository;


    public function __construct(
        CityRepositoryInterface $cityRepository,
        CategoryRepositoryInterface $categoryRepository,
        BoardingHouseRepositoryInterface $boardingHouseRepository
    ) {
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->boardingHouseRepository = $boardingHouseRepository;
    }

    public function find()
    {
        $cities = $this->cityRepository->getAllCities();
        $categories = $this->categoryRepository->getAllCategories();
        // Logic to find boarding houses
        return view('page.boarding-house.find', compact('cities', 'categories'));
    }


    public function findResults(Request $request)
    {
        $boardingHouses = $this->boardingHouseRepository->getAllBoardingHouses($request->search, $request->city, $request->category);
        return view('page.boarding-house.index', compact('boardingHouses'));
    }
}