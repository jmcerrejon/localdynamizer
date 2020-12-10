<?php

namespace Tests;

function actingAsAdmin(): TestCase
{
    app(\Database\Seeders\DatabaseSeeder::class)->call(\Database\Seeders\AdminsTableSeeder::class);
    return test()->actingAs(\App\Models\User::first(), 'admin');
}
