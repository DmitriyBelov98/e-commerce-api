<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryChild;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()

    {
        $category = Category::find(1);
//        $childCategories = CategoryChild::all();

        dd($category->childCategories);
    }
}
