<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mime;
use App\Models\User;
use App\Models\Hashtag;
use App\Models\Resource;
use Faker\Generator as Faker;

$factory->define(Resource::class, function (Faker $faker) {
    $userIds = User::get()->modelKeys();
    $mimeIds = Mime::get()->modelKeys();

    return [
        'user_id' => $userIds[array_rand($userIds, 1)],
        'mime_id' => $mimeIds[array_rand($mimeIds, 1)],
        'body' => $faker->paragraph,
        'path' => $faker->imageUrl(1024, 768),
        'views' => 23,
        'downloads' => 23,
    ];
});
