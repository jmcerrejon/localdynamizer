<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagResourceTable extends Migration
{
    public function up() : void
    {
        Schema::create('hashtag_resource', function (Blueprint $table) {
            $table->unsignedBigInteger('hashtag_id');
            $table->unsignedBigInteger('resource_id');

            $table->foreign('hashtag_id')->references('id')->on('hashtags')->cascadeOnDelete();
            $table->foreign('resource_id')->references('id')->on('resources')->cascadeOnDelete();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('hashtag_resource');
    }
}
