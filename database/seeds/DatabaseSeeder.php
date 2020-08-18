<?php

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
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(MimesTableSeeder::class);
        $this->call(HashtagsTableSeeder::class);
        $this->call(ResourcesTableSeeder::class);
        $this->call(HashtagResourcesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(InvoicesTableSeeder::class);
    }
}
