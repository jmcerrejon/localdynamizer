<?php

namespace Database\Factories;

use App\Models\Mime;
use App\Models\User;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resource::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds = User::get()->modelKeys();
        $mimeIds = Mime::get()->modelKeys();

        return [
            'title' => $this->faker->sentence(),
            'published' => true,
            'user_id' => $userIds[array_rand($userIds, 1)],
            'mime_id' => $mimeIds[array_rand($mimeIds, 1)],
            'body' => $this->faker->paragraph,
            'path' => $this->faker->imageUrl(1024, 768),
            'views' => $this->faker->numberBetween(0, 100),
            'downloads' => $this->faker->numberBetween(0, 100),
        ];
    }
}
