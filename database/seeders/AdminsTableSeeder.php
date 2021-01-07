<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    public function run() : void
    {
        DB::table('admins')->insert([
            [
                'name' => 'Jose Cerrejon (admin)',
                'email' => 'admin@dinamizadorlocal.com',
                'password' => '$2y$10$7HzofNKxFCjjdvyFdJk9TOUOWDlefF31no6oSKM3gPb8EiOg2N126' // secret
            ], 
            [
                'name' => 'Jose Cardenas (admin)',
                'email' => 'ceo@dinamizadorlocal.com',
                'password' => '$2y$10$7HzofNKxFCjjdvyFdJk9TOUOWDlefF31no6oSKM3gPb8EiOg2N126' // secret
            ], 
        ]);
    }
}
