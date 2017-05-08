<?php

namespace Modules\Club\Entities;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = [];
    protected $table = 'clubs';

    public function moders()
    {
      return $this->belongsToMany('App\User');
    }

    public function info()
    {
      return $this->hasOne('Modules\Category\Entities\Category', 'id', 'cinfo_id');
    }

    public function news()
    {
      return $this->hasOne('Modules\Category\Entities\Category', 'id', 'cnews_id');
    }
}
