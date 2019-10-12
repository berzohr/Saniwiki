<?php

use Faker\Generator as Faker;

$factory->define(App\AccessGroup::class, function (Faker $faker) {
    return [
        'name' => substr($faker->sentence(2), 0, -1),
    ];
});
