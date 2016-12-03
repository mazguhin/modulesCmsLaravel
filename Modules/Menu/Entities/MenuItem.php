<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Menu\Entities\Menu;

class MenuItem extends Model
{
    protected $table = 'menu_items';
    protected $fillable = [];

    public function menu()
    {
      return $this->belongsTo(Menu::class);
    }

    public function children()
    {
      return $this->hasMany($this, 'parent_id', 'id');
    }

    public function childrenActivated()
    {
      return $this->hasMany($this, 'parent_id', 'id')->where('activated',1);
    }

    public function role()
    {
      return $this->belongsTo('Modules\Dashboard\Entities\Role');
    }
}
