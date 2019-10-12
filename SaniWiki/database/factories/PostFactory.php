<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $categoriesIDs = DB::table('categories')->pluck('id');
    return [
        'title' => substr($faker->sentence(2), 0, -1),
        'category' => $faker->randomElement($categoriesIDs),
        'date' => Carbon::create('2000', '01', '01'),
        'author' => substr($faker->sentence(2), 0, -1)
    ];
});