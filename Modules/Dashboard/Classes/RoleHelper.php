<?php
namespace Modules\Dashboard\Classes;

use Auth;

class RoleHelper {

    private $role;

    public function __construct()
    {
      if (Auth::check()) {
        $this->role = Auth::user()->role->name;
      } else {
        $this->role = 'guest';
      }
    }

    public function isAdmin()
    {
        return ($this->role=="administrator");
    }

    public function isBanned()
    {
        return ($this->role=="banned");
    }

    public function isModer()
    {
        return ($this->role=="moderator");
    }

    public function isAdminOrModer()
    {
        return ($this->role=="moderator" || $this->role=="administrator");
    }

    public function checkAdmin(\App\User $user)
    {
        return ($user->role->name=="administrator");
    }

    public function checkModer(\App\User $user)
    {
        return ($user->role->name=="moderator");
    }

    public function checkAdminOrModer(\App\User $user)
    {
        return ($user->role->name=="moderator" || $user->role->name=="administrator");
    }

    public function validatePermissionForPage($pagePermission)
    {
        $permission = 1;
        if (Auth::check()) {
          $permission = Auth::user()->role->permission;
        }
        return $permission>=$pagePermission;
    }

    // true, если пользователь имеет право управлять клубом
    public function validatePermissionForClub($club_id)
    {
        if (!Auth::check())
          return 0;

        $user = Auth::user();

        if ($this->checkAdmin($user))
          return 1;

        $club = \Modules\Club\Entities\Club::findOrFail($club_id);
        foreach ($club->moders as $moder) {
          if ($moder->id == $user->id)
            return 1;
        }

        return 0;
    }
}
