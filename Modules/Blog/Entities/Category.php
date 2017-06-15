<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [];
    protected $table = 'blog_categories';

    public function blog()
    {
      return $this->belongsTo('Modules\Blog\Entities\Blog');
    }

    public function articles()
    {
      return $this->hasMany('Modules\Blog\Entities\Article');
    }
}
