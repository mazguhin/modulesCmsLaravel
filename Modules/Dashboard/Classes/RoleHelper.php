<?php
namespace Modules\Dashboard\Classes;

use Auth;

class RoleHelper {
    public function isAdmin()
    {
        if (Auth::check()) {
          return Auth::user()->role->name=="administrator";
        }
        else {
          return 0;
        }
    }
}
