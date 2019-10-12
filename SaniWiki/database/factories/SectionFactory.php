<?php

use Faker\Generator as Faker;


$factory->define(App\Section::class, function (Faker $faker) {
    $categoriesIDs = DB::table('categories')->pluck('id');
    return [
        'name' => substr($faker->sentence(2), 0, -1),
        'category' => $faker->randomElement($categoriesIDs),
        'iconFontAw' => 'fas fa-question',
        'iconURL' => $faker->url
    ];
});
