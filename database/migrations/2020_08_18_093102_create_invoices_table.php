<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    public function up() : void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_sid', 10)->unique();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->text('description');
            $table->boolean('is_notified')->default(false);
            $table->boolean('is_sent')->default(false);
            $table->boolean('is_charged')->default(false);
            $table->decimal('charge_amount', 6, 2);
            $table->unsignedTinyInteger('discount_percent')->default(0);
            $table->unsignedTinyInteger('tax')->default(21);
            $table->decimal('total_amount', 6, 2);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index(['store_id'], 'stores_fk0');
            $table->index(['payment_method_id'], 'payment_methods_fk0');

            $table->foreign('store_id')->references('id')->on('stores')->cascadeOnDelete();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('invoices');
    }
}
