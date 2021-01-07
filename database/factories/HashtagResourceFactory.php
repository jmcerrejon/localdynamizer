<?php

namespace Database\Factories;

use App\Models\Hashtag;
use App\Models\Resource;
use App\Models\HashtagResource;
use Illuminate\Database\Eloquent\Factories\Factory;

class HashtagResourceFactory extends Factory
{
    protected $model = HashtagResource::class;

    public function definition() : array
    {
        $hashtagIds = Hashtag::get()->modelKeys();
        $resourceIds = Resource::get()->modelKeys();

        return [
            'hashtag_id' => $hashtagIds[array_rand($hashtagIds, 1)],
            'resource_id' => $resourceIds[array_rand($resourceIds, 1)],
        ];
    }
}
