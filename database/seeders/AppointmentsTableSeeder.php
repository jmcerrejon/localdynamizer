<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    public function run() : void
    {
        \App\Models\Appointment::factory()->count(10)->create();
    }
}
