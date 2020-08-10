<?php

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    const TOTAL_STORES = 50;

    public function run()
    {
        factory(Store::class, self::TOTAL_STORES)->create();
    }
}
