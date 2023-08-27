<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Product;
use \App\Models\Category;
use \App\Models\Shop;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\User::factory(10)->create();
        Product::factory()->count(50)->create();
        $category = Category::factory()->create([
            'name' => 'Main Category '
        ]);
        Category::factory()->count(5)->create();
        Shop::factory()->count(10)->create();

        // attach product with categories
        foreach (Product::all() as $product) {
            $cats = Category::inRandomOrder()->take(rand(1,3))->pluck('id');
            $product->categories()->attach($cats);
        }
        // attach product with shops
        foreach (Product::all() as $product) {
            $shops = Shop::inRandomOrder()->take(rand(1,3))->pluck('id');
            $product->shops()->attach($shops);
        }

        \App\Models\Order::factory()->count(10)->create();
        \App\Models\OrderProduct::factory()->count(50)->create();


    }
}
