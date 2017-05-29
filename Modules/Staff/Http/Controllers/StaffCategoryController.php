<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Staff\Entities\StaffCategory;
use Settings;
use Cache;

class StaffCategoryController extends Controller
{
     protected $frontTemplate = '';

     public function __construct()
     {
       $this->frontTemplate = Settings::getFrontTemplate();
     }

     public function show($category)
     {
       return view('template::front.'.$this->frontTemplate.'.staff.category.showCategory', [
         'category' => $category,
         'staffs' => $category->staffs()->orderBy('created_at', 'asc')->paginate(5)
       ]);
     }

     public function showId($id_category)
     {
       return $this->show(Cache::get('staffCategory.'.$id_category, function() use ($id_category) {
         $tmpCategory = StaffCategory::where('id',$id_category)->firstOrFail();
         Cache::add('staffCategory.'.$id_category, $tmpCategory, 30); // cache 30 min
         return $tmpCategory;
       }));
     }


     public function showSlug($slug_category)
     {
       return $this->show(StaffCategory::where('slug',$slug_category)->firstOrFail());       
     }

    public function index()
    {
      return view('template::front.'.$this->frontTemplate.'.staff.category.index', [
        'categories' => StaffCategory::orderBy('created_at', 'asc')->paginate(5)
      ]);
    }
}
