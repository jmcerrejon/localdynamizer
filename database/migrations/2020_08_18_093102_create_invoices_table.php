<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_sid', 10);
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->text('description');
            $table->boolean('is_notified')->default(false);
            $table->boolean('is_sent')->default(false);
            $table->boolean('is_charged')->default(false);
            $table->decimal('charge_amount', 6, 2);
            $table->decimal('discount_amount', 6, 2);
            $table->unsignedTinyInteger('tax')->default(21);
            $table->decimal('total_amount', 6, 2);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
