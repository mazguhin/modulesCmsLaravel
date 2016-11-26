<?php
namespace Modules\Dashboard\Classes;

use Auth;

class RoleHelper {
    public function isAdmin()
    {
        return Auth::user()->role->name=="administrator";
    }
}
