<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            'type' => 'Tarjeta de crédito',
        ]);
        DB::table('payment_methods')->insert([
            'type' => 'Banco',
        ]);
        DB::table('payment_methods')->insert([
            'type' => 'Contado',
        ]);
        DB::table('payment_methods')->insert([
            'type' => 'Bizum',
        ]);
        DB::table('payment_methods')->insert([
            'type' => 'Paypal',
        ]);
        DB::table('payment_methods')->insert([
            'type' => 'Otros',
        ]);
    }
}
