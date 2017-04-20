<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticlescategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articlescategories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('lft')->unsigned()->nullable();
            $table->integer('rgt')->unsigned()->nullable();
            $table->integer('depth')->unsigned()->nullable();
            $table->integer('order')->unsigned()->nullable();
            $table->string('url', 80)->nullable();
            $table->boolean('status')->default(2);
            $table->string('title', 80)->nullable();
            $table->string('description', 1024)->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords', 500)->nullable();
            $table->string('meta_title', 80)->nullable();
            $table->text('seo_helper', 65535)->nullable();
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articlescategories');
    }
}
