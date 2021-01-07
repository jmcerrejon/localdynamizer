<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationUserTable extends Migration
{
    public function up() : void
    {
        Schema::create('location_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('location_id');
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('location_user');
    }
}
