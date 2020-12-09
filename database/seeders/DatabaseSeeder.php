<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PaymentMethodsTableSeeder::class,
            UsersTableSeeder::class,
            LocationsTableSeeder::class,
            ServicesTableSeeder::class,
            StoresTableSeeder::class,
            MimesTableSeeder::class,
            HashtagsTableSeeder::class,
            ResourcesTableSeeder::class,
            HashtagResourcesTableSeeder::class,
            InvoicesTableSeeder::class,
            AppointmentsTableSeeder::class,
            AdminsTableSeeder::class,
        ]);
    }
}
