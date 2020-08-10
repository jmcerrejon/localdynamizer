<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->string('comercial_name', 100);
            $table->string('business_name', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('contact_name', 100);
            $table->string('address', 191);
            $table->string('locality', 150)->nullable();
            $table->string('population', 150)->nullable();
            $table->string('postal_code', 5);
            $table->string('email', 50);
            $table->string('public_phone', 15)->nullable();
            $table->string('contact_phone', 15);
            $table->string('whatsapp', 15)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('subscription_type', 15);
            $table->string('logo_path', 191)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index(['user_id'], 'users_fk0');
            $table->index(['payment_method_id'], 'payment_method_fk1');

			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
			$table->foreign('payment_method_id')->references('id')->on('payment_methods')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
