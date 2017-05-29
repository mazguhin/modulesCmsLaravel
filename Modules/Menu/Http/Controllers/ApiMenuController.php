<?php

namespace Modules\Menu\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Menu\Entities\Menu;

class ApiMenuController extends Controller
{
    // отдаем публичные активные меню и пункты
    public function index()
    {
        $result = collect([]);

        foreach (Menu::all() as $menu) {
          if ($menu->role_id==1 && $menu->activated==1) {
            $menuitems = collect([]);
            foreach ($menu->menuActivatedPublicItems as $item)
              $menuitems->push($item);

            $result->push($menu, [$menuitems]);
          }
        }

        return response()->json($result);
    }
}
