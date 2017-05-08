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

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function role()
    {
      return $this->belongsTo('Modules\Dashboard\Entities\Role');
    }

    public function cinfo()
    {
      return $this->belongsTo('Modules\Club\Entities\Club', 'cinfo_id', 'id');
    }

    public function cnews()
    {
      return $this->belongsTo('Modules\Club\Entities\Club', 'cnews_id', 'id');
    }
}
