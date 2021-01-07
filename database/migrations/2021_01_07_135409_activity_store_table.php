<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActivityStoreTable extends Migration
{
    public function up() : void
    {
        Schema::create('activity_store', function (Blueprint $table) {
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('activity_store');
    }
}
