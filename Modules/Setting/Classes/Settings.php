<?php

namespace Modules\Setting\Classes;

use Modules\Setting\Entities\Setting;

class Settings
{
  public function get($name)
  {
    return Setting::where('name',$name)->firstOrFail()->value;
  }
}
