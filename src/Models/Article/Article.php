<?php
/**
 * Created by PhpStorm.
 * User: gennadiy
 * Date: 16.04.2017
 * Time: 17:54
 */


namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //


    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articlescategories()
    {
        return $this->belongsToMany('App\Models\Article\Articlescategory', 'articles_has_categories');
    }


}