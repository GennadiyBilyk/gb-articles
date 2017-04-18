<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticleHasCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_has_categories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('articlescategory_id')->unsigned()->index('fk_articles_articlecategories_articlecategories1_idx');
            $table->integer('article_id')->unsigned()->index('fk_articles_articlecategories_articles1_idx');
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
        Schema::drop('articles_has_categories');
    }

}
