<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsTableSeeder extends Seeder
{
    public function run() : void
    {
        DB::table('payment_methods')->insert([
            ['type' => 'Tarjeta de crédito' ],
            ['type' => 'Banco' ],
            ['type' => 'Contado' ],
            ['type' => 'Bizum' ],
            ['type' => 'Paypal' ],
            ['type' => 'Otros' ],
        ]);
    }
}
