<?php

namespace Database\Seeders;

use App\Models\ActivityStore;
use Illuminate\Database\Seeder;

class ActivityStoresTableSeeder extends Seeder
{
    const TOTAL_ACTIVITY = 50;

    public function run() : void
    {
        ActivityStore::factory(self::TOTAL_ACTIVITY)->create();
    }
}
