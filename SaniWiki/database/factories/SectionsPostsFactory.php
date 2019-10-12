<?php

use Faker\Generator as Faker;

$factory->define(App\SectionsPosts::class, function (Faker $faker) {
    $sectionsIDs = DB::table('sections')->pluck('id');
    $postsIDs = DB::table('posts')->pluck('id');
    return [
        'body' => substr($faker->sentence(2), 0, -1),
        'section' => $faker->randomElement($sectionsIDs),
        'post' => $faker->randomElement($postsIDs)
    ];
});