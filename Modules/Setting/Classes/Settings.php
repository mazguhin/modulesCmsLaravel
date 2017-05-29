<?php

namespace Modules\Setting\Classes;

use Modules\Setting\Entities\Setting;
use Cache;

class Settings
{

  // CACHE: prefix - setting.

  //get value of settings
  public function get($name)
  {
    $setting = Cache::get('setting.'.$name, function () use ($name) {
      $tmpSetting = Setting::where('name',$name)->firstOrFail()->value;
      Cache::add('setting.'.$name, $tmpSetting, 1440);
      return $tmpSetting;
    });

    return $setting;
  }

  public function getFrontTemplate()
  {
    return $this->get('frontTemplate');
  }

  public function getBackTemplate()
  {
    return $this->get('backTemplate');
  }
}
