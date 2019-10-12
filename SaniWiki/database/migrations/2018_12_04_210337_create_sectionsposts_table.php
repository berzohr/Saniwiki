<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('sections_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('body');
            $table->unsignedInteger('section');
            $table->unsignedInteger('post');
            $table->timestamps();

            $table->foreign('section')
                ->references('id')
                ->on('sections')
                ->onDelete('cascade');

            $table->foreign('post')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections_posts');
    }
}
