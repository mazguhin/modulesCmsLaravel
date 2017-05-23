<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Staff\Entities\StaffCategory;
use Settings;

class StaffCategoryController extends Controller
{
     protected $frontTemplate = '';

     public function __construct()
     {
       $this->frontTemplate = Settings::getFrontTemplate();
     }

     public function showId($id_category)
     {
       $category = StaffCategory::where('id',$id_category)->firstOrFail();

       return view('template::front.'.$this->frontTemplate.'.staff.category.showCategory', [
         'category' => $category,
         'staffs' => $category->staffs()->orderBy('created_at', 'asc')->paginate(10)
       ]);
     }


     public function showSlug($slug_category)
     {
       $category = StaffCategory::where('slug',$slug_category)->firstOrFail();

       return view('template::front.'.$this->frontTemplate.'.staff.category.showCategory', [
         'category' => $category,
         'staffs' => $category->staffs()->orderBy('created_at', 'asc')->paginate(10)
       ]);
     }

    public function index()
    {
      return view('template::front.'.$this->frontTemplate.'.staff.category.index', [
        'categories' => StaffCategory::orderBy('created_at', 'asc')->paginate(5)
      ]);
    }
}
