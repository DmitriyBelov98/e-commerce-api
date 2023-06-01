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



        // Собираем каждый внесённый продукт в коллекцию и возвращаем в виде массива
        // позволяет добавлять сразу несколько продуктов
        $products = collect($request->products)->keyBy('id')->map(function ($product) use ($request) {
//
            return [
                'quantity' => $product['quantity']
            ];

        })->toArray();

        $request->user()->cart()->syncWithoutDetaching($products);
        return response()->json([
            'message' => 'success'
        ]);
//        return new CartResource($product);
    }


//
    public function updateQuantityForUpdateCartMethod($productId , $quantity , Request $request)
    {
        $request->user()->cart()->updateExistingPivot($productId , [
            'quantity' => $quantity
        ]);
    }

    public function update(ProductVariation $productVariation , CartUpdateRequest $request)
    {
        $this->updateQuantityForUpdateCartMethod($productVariation->id , $request->quantity , $request);
    }

    public function deleteForDestroyCartMethod(Request $request, $productId)
    {
        $request->user()->cart()->detach($productId);

    }

    public function destroy(ProductVariation $productVariation)
    {
        $this->deleteForDestroyCartMethod(request(),$productVariation->id);
    }


}
