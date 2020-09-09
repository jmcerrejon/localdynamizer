<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    const TOTAL_STORES = 50;

    public function run()
    {
        Store::factory(self::TOTAL_STORES)->create();
    }
}
