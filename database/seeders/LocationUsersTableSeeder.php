<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationUsersTableSeeder extends Seeder
{
    public function run() : void
    {
        DB::table('location_user')->insert([
           'user_id' => 1,
           'location_id' => 1
        ]);
    }
}
