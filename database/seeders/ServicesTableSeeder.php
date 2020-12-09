<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'description' => 'Plan Gratuíto',
            'price' => 0,
        ]);

        DB::table('services')->insert([
            'description' => 'Plan Básico',
            'price' => 50,
        ]);

        DB::table('services')->insert([
            'description' => 'Plan Premium',
            'price' => 100,
        ]);
    }
}
