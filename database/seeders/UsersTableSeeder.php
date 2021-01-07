<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run() : void
    {
        DB::table('users')->insert([
            [
                'name' => 'Jose Cerrejon (dinamizador)',
                'email' => 'ulysess@gmail.com',
                'phone1' => '555123456',
                'email_verified_at' => new DateTime(),
                'password' => '$2y$10$7HzofNKxFCjjdvyFdJk9TOUOWDlefF31no6oSKM3gPb8EiOg2N126' // secret
            ],
            [
                'name' => 'Jose Cardenas (dinamizador)',
                'email' => 'ceo@dinamizadorlocal.com',
                'phone1' => '555654321',
                'email_verified_at' => new DateTime(),
                'password' => '$2y$10$7HzofNKxFCjjdvyFdJk9TOUOWDlefF31no6oSKM3gPb8EiOg2N126' // secret
            ]
        ]);
    }
}
