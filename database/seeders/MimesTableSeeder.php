<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mimes')->insert([
            'name' => 'text',
        ]);
        DB::table('mimes')->insert([
            'name' => 'image',
        ]);
        DB::table('mimes')->insert([
            'name' => 'video',
        ]);
        DB::table('mimes')->insert([
            'name' => 'gif',
        ]);
    }
}
