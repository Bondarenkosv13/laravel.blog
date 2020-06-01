<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(ProductsTableSeeders::class);
         $this->call(OrdersStatusTableSeeder::class);
         $this->call(OrdersTableSeeder::class);
         $this->call(OrdersProductsTableSeeder::class);
    }
}
