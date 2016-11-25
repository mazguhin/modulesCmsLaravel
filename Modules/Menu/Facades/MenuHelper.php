<?php
namespace Modules\Menu\Facades;
use Illuminate\Support\Facades\Facade;

class MenuHelper extends Facade{
    protected static function getFacadeAccessor() { return 'menuHelper'; }
}
