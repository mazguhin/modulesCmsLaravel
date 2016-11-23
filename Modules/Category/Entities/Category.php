<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [];

    public function articles()
    {
      return $this->hasMany('Modules\Article\Entities\Article');
    }
}
