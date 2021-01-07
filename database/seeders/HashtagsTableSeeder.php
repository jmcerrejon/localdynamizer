<?php

namespace Database\Seeders;

use App\Models\Hashtag;
use Illuminate\Database\Seeder;

class HashtagsTableSeeder extends Seeder
{
    const TOTAL_HASHTAGS = 50;

    public function run() : void
    {
        Hashtag::factory(self::TOTAL_HASHTAGS)->create();
    }
}
