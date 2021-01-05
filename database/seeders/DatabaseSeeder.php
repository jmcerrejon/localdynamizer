<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('import:locations');

        $this->call([
            PaymentMethodsTableSeeder::class,
            UsersTableSeeder::class,
            ServicesTableSeeder::class,
            StoresTableSeeder::class,
            MimesTableSeeder::class,
            HashtagsTableSeeder::class,
            ResourcesTableSeeder::class,
            HashtagResourcesTableSeeder::class,
            InvoicesTableSeeder::class,
            AppointmentsTableSeeder::class,
            AdminsTableSeeder::class,
            LocationUsersTableSeeder::class,
        ]);
    }
}
