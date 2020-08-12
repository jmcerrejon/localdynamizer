<?php

use App\Models\HashtagResource;
use Illuminate\Database\Seeder;

class HashtagResourcesTableSeeder extends Seeder
{
    const TOTAL_RESOURCES = 50;
    
    function run()
    {
        factory(HashtagResource::class, self::TOTAL_RESOURCES)->create();
    }
}
