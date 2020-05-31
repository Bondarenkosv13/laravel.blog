<?php

use Illuminate\Database\Seeder;

class OrdersStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = config('ordersStatus');
        if(!empty($statuses)) {
            foreach ($statuses as $status) {
                $createOrderStatus[] = [
                    'type' => $status
                ];
            }
            DB::table('orders_statuses')->insert($createOrderStatus);
        }
    }
}
