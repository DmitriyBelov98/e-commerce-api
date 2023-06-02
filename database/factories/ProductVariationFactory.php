<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<ProductVariation>
 */
class ProductVariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => self::factoryForModel(Product::class)->create()->id,
            'name' => $this->faker->unique()->word,
            'product_variation_type_id' => self::factoryForModel(ProductVariationType::class)->create()->id,
        ];
    }
}
