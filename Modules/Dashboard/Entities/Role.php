<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [];

    public function users()
    {
      return $this->hasMany('App\User');
    }

    public function articles()
    {
      return $this->hasMany('Modules\Article\Entities\Article');
    }

    public function categories()
    {
      return $this->hasMany('Modules\Category\Entities\Category');
    }

    public function menus()
    {
      return $this->hasMany('Modules\Menu\Entities\Menu');
    }

    public function menuItems()
    {
      return $this->hasMany('Modules\MenuItem\Entities\MenuItem');
    }
}
