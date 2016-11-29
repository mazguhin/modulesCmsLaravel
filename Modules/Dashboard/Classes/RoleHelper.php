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
}
