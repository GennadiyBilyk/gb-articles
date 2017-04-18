<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticlesTable extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_author_id')->unsigned()->nullable();
            $table->string('meta_description');
            $table->string('meta_title')->unique();
            $table->string('meta_keywords');
            $table->string('h1');
            $table->string('title');
            $table->string('anons');
            $table->string('url');
            $table->text('body');

            $table->timestamps();

            $table->foreign('article_author_id')->references('id')->on('article_authors')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
