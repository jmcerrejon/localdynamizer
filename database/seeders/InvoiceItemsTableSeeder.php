<?php

namespace Database\Seeders;

use App\Models\Invoiceitem;
use Illuminate\Database\Seeder;

class InvoiceItemsTableSeeder extends Seeder
{
    const TOTAL_ITEMS = 10;

    public function run()
    {
        Invoiceitem::factory(self::TOTAL_ITEMS)->create();
    }
}
