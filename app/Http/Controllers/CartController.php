<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartStoreRequest;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(CartStoreRequest $request)
    {

//        dd($request->user()->cart()->where('product_variation_id', '3')->first());
//        $user = $request->user();


        // Собираем каждый внесённый продукт в коллекцию
        $products = collect($request->products)->keyBy('id')->map( function ($product) use ($request) {


                return [
                    'quantity' => $product['quantity'] + $this->test($request, $product['id'])
                ];



        })->toArray();

        $request->user()->cart()->syncWithoutDetaching($products);
    }

    public function test(CartStoreRequest $request, $productId)
    {
        if ($product = $request->user()->cart()->where('product_variation_id', $productId)->first()) {
            return $product->pivot->quantity;
        }
        return 0;
    }
}
