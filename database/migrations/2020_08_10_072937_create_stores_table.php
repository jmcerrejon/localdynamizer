<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    public function up() : void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('location_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->string('comercial_name', 100);
            $table->string('business_name', 100)->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('contact_name', 100);
            $table->string('cif', 9);
            $table->string('address', 191);
            $table->string('locality', 150)->nullable();
            $table->string('population', 150)->nullable();
            $table->string('postal_code', 5);
            $table->string('email', 50);
            $table->string('public_phone', 15)->nullable();
            $table->string('contact_phone', 15);
            $table->string('whatsapp', 15)->nullable();
            $table->string('website', 150)->nullable();
            $table->string('subscription_type', 15);
            $table->string('logo_path', 191)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index('comercial_name');
            $table->index('business_name');
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('stores');
    }
}
