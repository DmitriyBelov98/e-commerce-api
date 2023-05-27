<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function index()
    {




        return ProductResource::collection(
            Product::all()
        );


    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}
