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
            $table->string('substription_type', 15);
            $table->string('logo_path', 191);
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
        Schema::dropIfExists('stores');
    }
}
