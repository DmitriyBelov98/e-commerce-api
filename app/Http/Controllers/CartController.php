<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartStoreRequest;
use App\Http\Requests\CartUpdateRequest;
use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller


{
    public function index(Request $request)
    {
        return new CartResource($request->user());
    }
    public function store(CartStoreRequest $request)
    {

//        dd($request->user()->cart()->where('product_variation_id', '3')->first());
//        $user = $request->user();


        // Собираем каждый внесённый продукт в коллекцию
        $products = collect($request->products)->keyBy('id')->map( function ($product) use ($request) {


                return [
                    'quantity' => $product['quantity'] + $this->updateQuantityForStoreItems($request, $product['id'])
                ];



        })->toArray();

        $request->user()->cart()->syncWithoutDetaching($products);
    }

    public function updateQuantityForStoreItems(CartStoreRequest $request, $productId)
    {
        if ($product = $request->user()->fresh()->cart()->where('product_variation_id', $productId)->first()) {
            return $product->pivot->quantity;
        }
        return 0;
    }
    public function updateQuantityForUpdateCartMethod( $productId, $quantity, Request $request)
    {
       $request->user()->cart()->updateExistingPivot($productId, [
           'quantity' => $quantity
       ]);
    }

    public function update(ProductVariation $productVariation, CartUpdateRequest $request)
    {
       $this->updateQuantityForUpdateCartMethod($productVariation->id, $request->quantity, $request);
    }


}
