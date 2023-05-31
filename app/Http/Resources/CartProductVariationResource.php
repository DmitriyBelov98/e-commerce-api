<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductVariationsResource;
use App\Http\Resources\ProductResource;


class CartProductVariationResource extends ProductVariationsResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $total = $this->pivot->quantity * $this->product->price;
        return array_merge(parent::toArray($request), [

            'product' => new ProductResource($this->product),
            'quantity' => $this->pivot->quantity,
            'total' => $total

        ]);
    }
}
