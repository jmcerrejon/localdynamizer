<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Hashtag;
use App\Models\Resource;
use Faker\Generator as Faker;
use App\Models\HashtagResource;

$factory->define(HashtagResource::class, function (Faker $faker) {
    $hashtagIds = Hashtag::get()->modelKeys();
    $resourceIds = Resource::get()->modelKeys();

    return [
        'hashtag_id' => $hashtagIds[array_rand($hashtagIds, 1)],
        'resource_id' => $resourceIds[array_rand($resourceIds, 1)],
    ];
});
