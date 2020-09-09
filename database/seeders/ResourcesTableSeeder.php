<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    const TOTAL_RESOURCES = 50;

    public function run()
    {
        Resource::factory(self::TOTAL_RESOURCES)->create();
    }
}
