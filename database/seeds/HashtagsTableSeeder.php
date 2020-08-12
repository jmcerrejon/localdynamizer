<?php

use App\Models\Hashtag;
use Illuminate\Database\Seeder;

class HashtagsTableSeeder extends Seeder
{
    const TOTAL_HASHTAGS = 50;

    public function run()
    {
        factory(Hashtag::class, self::TOTAL_HASHTAGS)->create();
    }
}
