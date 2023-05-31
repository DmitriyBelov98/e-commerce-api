<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\ProductVariationType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'type' => $this->name ,

        ];
    }
}
