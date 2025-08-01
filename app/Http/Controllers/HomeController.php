<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Interface\CategoryRepositoryInterface;
use App\Interface\CityRepositoryInterface;
use App\Interface\BoardingHouseRepositoryInterface;

class HomeController extends Controller
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

    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();
        $popularBoardingHouses = $this->boardingHouseRepository->getPopularBoardingHouses();
        $getAllCities = $this->cityRepository->getAllCities();
        $getAllBoardingHouses = $this->boardingHouseRepository->getAllBoardingHouses();
        return view('page.home', compact('categories', 'popularBoardingHouses', 'getAllCities', 'getAllBoardingHouses'));
    }
}
