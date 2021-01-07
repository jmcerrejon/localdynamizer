<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    public function up() : void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('postal_code', 5);
            $table->char('dc', 1);
            $table->string('name', 100);
            $table->string('codauto', 2);
            $table->boolean('active')->nullable();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('locations');
    }
}
