<?php

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoicesTableSeeder extends Seeder
{
    const TOTAL_INVOICES = 50;

    public function run()
    {
        factory(Invoice::class, self::TOTAL_INVOICES)->create();
    }
}
