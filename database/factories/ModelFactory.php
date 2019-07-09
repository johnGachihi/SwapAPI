<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'password' => password_hash('1234', PASSWORD_DEFAULT),
        'phone_number' => $faker->e164PhoneNumber
    ];
});


/**
 * Factory definition for model GoodsFactory.
 */
$factory->define(App\Good::class, function (Faker\Generator $faker) {
    $imgFileNames = [
        'certain_flower.jpg', 'eiffel_tower.jpg', 'horns.jpg',
        'lioness.jpg', 'nice_view.jpg', 'river-between.jpg', 'tiger.jpg',
        'tomato_pair.jpg', 'x-mas_balls.jpg'
    ];
    $categories = ['books', 'clothes'];

    return [
        'user_id' => $faker->numberBetween(1,2),
        'name' => $faker->sentence(rand(2, 4), true),
        'description' => $faker->paragraph(rand(2,3), true),
        'price_estimate' => $faker->numberBetween(50, 10000),
//        'price_range_max' => $faker->numberBetween(100, 20000),
        'image_file_name' => $imgFileNames[rand(0, count($imgFileNames)-1)],
        'category' => $categories[rand(0, count($categories) - 1)]
    ];
});

$factory->define(App\SupplementaryGoodImage::class, function (Faker\Generator $faker) {
    $imgFileNames = [
        'certain_flower.jpg', 'eiffel_tower.jpg', 'horns.jpg',
        'lioness.jpg', 'nice_view.jpg', 'river-between.jpg', 'tiger.jpg',
        'tomato_pair.jpg', 'x-mas_balls.jpg'
    ];

    return [
        'image_filename' => $imgFileNames[$faker->numberBetween(0, count($imgFileNames)-1)]
    ];
});
