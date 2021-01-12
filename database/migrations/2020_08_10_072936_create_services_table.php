<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    public function up() : void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id()->comment('1, Basic and 2, Premium. If you change it, check the orderBy on Model Store');
            $table->string('description', 191);
            $table->decimal('price', 6, 2);
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('services');
    }
}
