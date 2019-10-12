<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => substr($faker->sentence(2), 0, -1),
        'iconFontAw' => 'fas fa-question',
        'iconURL' => '',
        'type' => $faker->numberBetween(0,3),
        'bgImage' => 'cat001-bg.jpg'
    ];
});
