<?php

namespace Modules\Menu\Classes;
use Modules\Menu\Entities\Menu;
use Cache;

class MenuHelper {
    public function getMenuByRole($role)
    {
      return Menu::where('role',$role)->firstOrFail();
    }

    public function getAll() {
      return Cache::get('menu.all', function () {
        $tmpMenuAll = Menu::all();
        Cache::add('menu.all', $tmpMenuAll, 1440);
        return $tmpMenuAll;
      });
    }
}
