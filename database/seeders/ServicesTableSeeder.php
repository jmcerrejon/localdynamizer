<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    public function run() : void
    {
        DB::table('services')->insert([
            [
                'description' => 'Plan Gratuíto',
                'price' => 0,
            ],
            [
                'description' => 'Plan Premium',
                'price' => 15,
            ],
        ]);
    }
}
