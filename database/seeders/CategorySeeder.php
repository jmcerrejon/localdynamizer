<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run() : void
    {
        DB::table('categories')->insert([
            ['name' => 'Comida para llevar'],
            ['name' => 'Resturantes'],
            ['name' => 'Ocio'],
            ['name' => 'Alimentacion'],
            ['name' => 'Profesionales'],
            ['name' => 'Papeleria'],
            ['name' => 'Automocion'],
            ['name' => 'Moda'],
            ['name' => 'complementos'],
            ['name' => 'Salud y bienestar'],
        ]);
    }
}
