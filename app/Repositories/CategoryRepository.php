<?php 

namespace App\Repositories;

use App\Interface\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface{
    public function getAllCategories()
    {
        // Logic to retrieve all categories from the database
        return \App\Models\Category::all();
    }
}