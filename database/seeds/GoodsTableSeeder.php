<?php

use Illuminate\Database\Seeder;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Good::class, 500)->create()
            ->each(function ($good) {
                for($i = 0; $i <=5; $i++) {
                    $good->supplementaryGoodImages()->save(factory(App\SupplementaryGoodImage::class)->make());
                }
            });
    }
}
