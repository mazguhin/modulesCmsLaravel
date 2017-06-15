<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [];
    protected $table = 'blogs';

    public function moder()
    {
      return $this->belongsTo('App\User', 'moder_id', 'id');
    }

    public function categories()
    {
      return $this->hasMany('Modules\Blog\Entities\Category');
    }

    public function articles()
    {
      return $this->hasManyThrough('Modules\Blog\Entities\Article','Modules\Blog\Entities\Category');
    }
}
