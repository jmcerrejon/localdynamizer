<?php

namespace Database\Factories;

use App\Models\Hashtag;
use App\Models\Resource;
use App\Models\HashtagResource;
use Illuminate\Database\Eloquent\Factories\Factory;

class HashtagResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HashtagResource::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hashtagIds = Hashtag::get()->modelKeys();
        $resourceIds = Resource::get()->modelKeys();

        return [
            'hashtag_id' => $hashtagIds[array_rand($hashtagIds, 1)],
        'resource_id' => $resourceIds[array_rand($resourceIds, 1)],
        ];
    }
}
