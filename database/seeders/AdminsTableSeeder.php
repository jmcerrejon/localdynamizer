<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Jose Cerrejon (admin)',
            'email' => 'admin@dinamizadorsocial.com',
            'password' => '$2y$10$7HzofNKxFCjjdvyFdJk9TOUOWDlefF31no6oSKM3gPb8EiOg2N126', // secret
        ]);

        DB::table('admins')->insert([
            'name' => 'Jose Cardenas (admin)',
            'email' => 'ceo@dinamizadorsocial.com',
            'password' => '$2y$10$7HzofNKxFCjjdvyFdJk9TOUOWDlefF31no6oSKM3gPb8EiOg2N126', // secret
        ]);
    }
}
