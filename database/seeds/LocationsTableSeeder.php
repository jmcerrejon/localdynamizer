<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'name' => 'Isla Cristina',
            'postal_code' => '21400',
            'slug' => 'isla-cristina',
        ]);

        DB::table('location_user')->insert([
            'user_id' => 1,
            'location_id' => 1,
        ]);
    }
}
