<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMimesTable extends Migration
{
    public function up() : void
    {
        Schema::create('mimes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 5);
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('mimes');
    }
}
