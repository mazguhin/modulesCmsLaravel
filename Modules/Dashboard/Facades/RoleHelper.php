<?php
namespace Modules\Dashboard\Facades;
use Illuminate\Support\Facades\Facade;

class RoleHelper extends Facade{
    protected static function getFacadeAccessor() { return 'RoleHelper'; }
}
