<?php

namespace Modules\Setting\Classes;

use Modules\Setting\Entities\Setting;

class Settings
{

  //get value of settings
  public function get($name)
  {
    return Setting::where('name',$name)->firstOrFail()->value;
  }

  //for front templates
  public function getFrontTemplate()
  {
    return Setting::where('name','frontTemplate')->firstOrFail()->value;
  }

  public function getFrontTemplatePath()
  {
    return 'template::templates.front.'.$this->getFrontTemplate().'.layouts.main';
  }

  // for back templates
  public function getBackTemplate()
  {
    return Setting::where('name','backTemplate')->firstOrFail()->value;
  }

  public function getBackTemplatePath()
  {
    return 'template::templates.back.'.$this->getBackTemplate().'.layouts.main';
  }
}
