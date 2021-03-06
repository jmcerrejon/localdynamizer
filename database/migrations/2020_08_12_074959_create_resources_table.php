<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    public function up() : void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mime_id');
            $table->string('title', 191);
            $table->boolean('published');
            $table->text('body',);
            $table->string('path', 191)->nullable();
            $table->string('views', 191)->default(0);
            $table->string('downloads', 191)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index('title');
            
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('mime_id')->references('id')->on('mimes')->cascadeOnUpdate();
        });
        // Laravel doesn't support full text search migration
        DB::statement('ALTER TABLE `resources` ADD FULLTEXT INDEX resource_body_index (body)');
    }

    public function down() : void
    {
        Schema::table('resources', function($table) {
            $table->dropIndex('resource_body_index');
        });
        Schema::dropIfExists('resources');
    }
}
