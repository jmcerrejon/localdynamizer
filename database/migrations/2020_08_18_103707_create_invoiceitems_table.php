<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceitemsTable extends Migration
{
    public function up() : void
    {
        Schema::create('invoiceitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('invoice_id');
            $table->string('description', 191);
            $table->decimal('price', 6, 2);
            $table->unsignedinteger('quantity')->default(1);

            $table->index(['service_id'], 'services_fk0');
            $table->index(['invoice_id'], 'invoices_fk0');

            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('invoice_id')->references('id')->on('invoices');
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('invoiceitems');
    }
}
