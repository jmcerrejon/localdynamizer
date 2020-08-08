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
        DB::table('users')->insert([
            'name' => 'Jose Cerrejon',
            'email' => 'ulysess@gmail.com',
			'email_verified_at' => new DateTime(),
            'password' => '$2y$10$7HzofNKxFCjjdvyFdJk9TOUOWDlefF31no6oSKM3gPb8EiOg2N126', // secret
			'created_at' => new DateTime(),
			'updated_at' => new DateTime(),
        ]);
    }
}
