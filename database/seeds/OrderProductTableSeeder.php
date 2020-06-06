<?php

use Illuminate\Database\Seeder;

class OrderProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         *  Разобрался, я так понял нужно использовать метод attach вместо updateExistingPivot.
         *
         * Плохо, что дз сдать только 2 раза, теперь я ничего там менять не могу.
         */


        factory(\App\Models\Order::class, 10)->create()->each(function (\App\Models\Order $order) {
            $countOfProduct = rand(1, 5);
            for($i = 0; $i < $countOfProduct; $i++) {
                $quantity = rand(1, 5);
                $products = \App\Models\Product::where('id', '=', rand(1, 5))->first();;

               $products->orders()->attach($order, [
                    'quantity' => $quantity,
                    'price'    => $products->price
                ]);
               }
        });
    }
}
