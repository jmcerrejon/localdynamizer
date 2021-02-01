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
            $table->foreignId('service_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('location_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('payment_method_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('is_active')->default(1);
            $table->string('commercial_name', 100);
            $table->string('business_name', 100)->nullable();
            $table->string('cif', 9);
            $table->string('contact_name', 100);
            $table->string('address', 191);
            $table->string('postal_code', 5);
            $table->string('contact_phone', 15);
            $table->string('public_phone', 15)->nullable();
            $table->string('whatsapp', 15)->nullable();
            $table->string('email', 50);
            $table->string('email_public', 50)->nullable();
            $table->string('logo_path', 191)->nullable();
            $table->string('website', 150)->nullable();
            $table->string('slogan', 100)->nullable();
            $table->text('description')->nullable();
            $table->json('opening_hours')->nullable();
            // TODO social networks on a new table
            $table->string('facebook', 50)->nullable();
            $table->string('instagram', 50)->nullable();
            $table->string('twitter', 50)->nullable();
            $table->string('tripadvisor', 50)->nullable();
            $table->string('tiktok', 50)->nullable();
            $table->string('menu_es', 150)->nullable();
            $table->string('menu', 150)->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index('commercial_name');
            $table->index('business_name');
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('stores');
    }
}
