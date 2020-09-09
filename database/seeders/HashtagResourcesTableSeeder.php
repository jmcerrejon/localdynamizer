<?php

namespace Database\Seeders;

use App\Models\HashtagResource;
use Illuminate\Database\Seeder;

class HashtagResourcesTableSeeder extends Seeder
{
    const TOTAL_RESOURCES = 50;
    
    function run()
    {
        HashtagResource::factory(self::TOTAL_RESOURCES)->create();
    }
}
