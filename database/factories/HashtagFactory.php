<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Hashtag;
use Faker\Generator as Faker;

$factory->define(Hashtag::class, function (Faker $faker) {
    return [
        'name' => '#'.$faker->word,
    ];
});
