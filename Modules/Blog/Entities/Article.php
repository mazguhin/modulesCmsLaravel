<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [];
    protected $table = 'blog_articles';

    public function category()
    {
      return $this->belongsTo('Modules\Blog\Entities\Category');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
