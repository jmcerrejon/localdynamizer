<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MimesTableSeeder extends Seeder
{
    public function run() : void
    {
        DB::table('mimes')->insert([
            ['name' => 'text'],
            ['name' => 'image'],
            ['name' => 'video'],
            ['name' => 'gif'],
        ]);
    }
}
