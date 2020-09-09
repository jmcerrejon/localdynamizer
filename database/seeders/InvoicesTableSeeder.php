<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoicesTableSeeder extends Seeder
{
    const TOTAL_INVOICES = 50;

    public function run()
    {
        Invoice::factory(self::TOTAL_INVOICES)->create();
    }
}
