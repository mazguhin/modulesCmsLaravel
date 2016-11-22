<?php
namespace Modules\Template\Facades;
use Illuminate\Support\Facades\Facade;

class TemplateInfo extends Facade{
    protected static function getFacadeAccessor() { return 'templateinfo'; }
}
