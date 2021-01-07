<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    public function up() : void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);

        });
    }

    public function down() : void
    {
        Schema::dropIfExists('activities');
    }
}
