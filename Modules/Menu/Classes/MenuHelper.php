<?php

namespace Modules\Menu\Classes;
use Modules\Menu\Entities\Menu;

class MenuHelper {
    public function getMenuByRole($role)
    {
      return Menu::where('role',$role)->firstOrFail();
    }
}
