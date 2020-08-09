<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // TODO To theirs own seed file
        DB::table('locations')->insert([
            'name' => 'Isla Cristina',
            'postal_code' => '21400',
            'slug' => 'isla-cristina',
        ]);
        
        DB::table('users')->insert([
            'name' => 'Jose Cerrejon',
            'email' => 'ulysess@gmail.com',
			'email_verified_at' => new DateTime(),
            'password' => '$2y$10$7HzofNKxFCjjdvyFdJk9TOUOWDlefF31no6oSKM3gPb8EiOg2N126', // secret
			'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
        ]);

        // TODO Just for quick test. Change with their respective IDs 
        DB::table('location_user')->insert([
            'user_id' => 1,
            'location_id' => 1,
        ]);
    }
}
