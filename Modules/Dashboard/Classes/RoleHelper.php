<?php
namespace Modules\Dashboard\Classes;

use Auth;

class RoleHelper {
    public function isAdmin()
    {
        return (Auth::check() && Auth::user()->role->name=="administrator");
    }

    public function isModer()
    {
        return (Auth::check() && Auth::user()->role->name=="moderator");
    }

    public function validatePermissionForPage($pagePermission)
    {
        $permission = 0;
        if (Auth::check()) {
          $permission = Auth::user()->role->permission;
        } else {
          $permission = 1;
        }
        return $permission>=$pagePermission;
    }
}
