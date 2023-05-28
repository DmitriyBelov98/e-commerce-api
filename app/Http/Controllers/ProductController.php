<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\CustomFilter\FiltersProductCategories;

class ProductController extends Controller
{
    public function index()
    {




        $products = QueryBuilder::for(Product::class)
            ->allowedFilters(
                [
                    AllowedFilter::custom('category', new FiltersProductCategories),
                    'name' ,
                    'slug' ,
                    'price',


                ] ,

            )
            ->get();
        return ProductResource::collection(
            $products
        );


    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}
