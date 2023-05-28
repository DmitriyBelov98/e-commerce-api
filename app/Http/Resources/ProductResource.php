<?php

namespace App\Http\Resources;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name ,
            'slug' => $this->slug,
            'price' => $this->price,
            'description' => $this->description,
            'variations' => VariationResource::collection($this->variations),
        ];
    }
}
