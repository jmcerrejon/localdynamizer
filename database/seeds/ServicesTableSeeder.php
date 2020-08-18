<?php

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
            'description' => 'Servicio dinamizador',
            'price' => 50,
        ]);
        DB::table('services')->insert([
            'description' => 'Servicio mantenimiento',
            'price' => 50,
        ]);
        DB::table('services')->insert([
            'description' => 'Servicio SEO',
            'price' => 50,
        ]);
    }
}
