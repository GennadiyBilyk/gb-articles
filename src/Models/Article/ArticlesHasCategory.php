<?php
/**
 * Created by PhpStorm.
 * User: bilyk
 * Date: 24.07.2016
 * Time: 19:26
 */

namespace App\Models\Article;


use Illuminate\Database\Eloquent\Model;


class ArticlesHasCategory extends Model
{

    protected $fillable = ['articlescategory_id','article_id'];
}