<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*USE php artisan db:seed --class=<the-seeder-class>
          INSTEAD OF THIS CLASS.
        */
         $this->call([
             UsersTableSeeder::class,
             GoodsTableSeeder::class
         ]);
    }
}
