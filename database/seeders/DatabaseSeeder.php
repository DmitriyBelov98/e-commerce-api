<?php

namespace Database\Seeders;

use App\Models\ProductVariationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\User;
use App\Models\Address;
use Database\Factories\AddressFactory;
use Database\Factories\OrderFactory;
use Database\Factories\ProductVariationTypeFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         $category = Category::factory(10)->create();
         $product = Product::factory(10)->hasAttached($category)->create();
         $productVariation = ProductVariation::factory(10)->create();
         $productVariationType = ProductVariationTypeFactory::factoryForModel(ProductVariationType::class)->count(5)->create();
         AddressFactory::factoryForModel(Address::class)->count(3)->create();







    }
}
