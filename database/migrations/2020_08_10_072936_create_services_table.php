<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    public function up() : void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('description', 191);
            $table->decimal('price', 6, 2);
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('services');
    }
}
