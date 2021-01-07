<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagsTable extends Migration
{
    public function up() : void
    {
        Schema::create('hashtags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);

            $table->index('name');
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('hashtags');
    }
}
