<?php

namespace App\Http\Resources;

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

        return array_merge(parent::toArray($request), [

            'product' => new ProductResource($this->product),
            'quantity' => $this->pivot->quantity,

        ]);
    }
}
