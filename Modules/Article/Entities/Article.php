<?php

namespace Modules\Article\Entities;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table='articles';
    protected $fillable = [];

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
