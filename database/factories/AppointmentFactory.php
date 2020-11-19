<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_time = now()->addHours(rand(1, 100));
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'title' => $this->faker->word,
            'start_time' => $start_time->format('Y-m-d H') . ':00',
            'finish_time' => $start_time->addHours(rand(1, 2))->format('Y-m-d H') . ':00',
            'comments' => $this->faker->text($maxNbChars = 200)
        ];
    }
}
