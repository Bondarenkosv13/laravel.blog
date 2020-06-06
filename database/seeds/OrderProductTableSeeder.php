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


        $count = 10;
        for($i=0; $i < $count; $i++) {
            $quantity = rand(1, 20);
            $product = \App\Models\Product::where('id', '=', rand(1, 5))->first();
            $order = \App\Models\Order::where('id', '=', rand(1, 5))->first();

            DB::table('order_product')->insert([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }
/**
 *  Код ниже с урока не рабоатет, не понимаю почему, не записываются данные в таблицу.
 * Вывел переменную $Prod, посмотреть что дает, рещультат = 0. Хз что делать. Сделал так как понял сам вверху.
 */
//        factory(\App\Models\Order::class, 10)->create()->each(function (\App\Models\Order $order) {
//            $countOfProduct = rand(1, 5);
//            for($i = 0; $i < $countOfProduct; $i++) {
//                $quantity = rand(1, 5);
//                $products = \App\Models\Product::all()->random();
//
//               $Prod =  $products->orders()->updateExistingPivot($order, [
//                    'quantity' => $quantity,
//                    'price'    => $products->price
//                ]);
//            }
//        });

    }
}
