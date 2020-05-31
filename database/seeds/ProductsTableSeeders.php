<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Product::class, 5)->create()
            ->each(function ($product) {
            $product->categories()->attach(\App\Models\Category::get()->random());
        });
    }
}
