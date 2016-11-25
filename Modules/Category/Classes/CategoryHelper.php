<?php

namespace Modules\Category\Classes;
use Modules\Category\Entities\Category;

class CategoryHelper {
    public function getAll()
    {
      return Category::all();
    }
}
