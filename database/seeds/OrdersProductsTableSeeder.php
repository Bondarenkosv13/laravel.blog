<?php

use Illuminate\Database\Seeder;

class OrdersProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quantity = rand(1, 20);
        $product = \App\Models\Product::where('id', '=', rand(1, 5))->first();
        $order = \App\Models\Order::where('id', '=', rand(1, 5))->first();

        DB::table('orders_products')->insert([
            'order_id'   => $order->id,
            'product_id' => $product->id,
            'quantity'   => $quantity,
            'price'      => $quantity * $product->price
        ]);
    }
}
