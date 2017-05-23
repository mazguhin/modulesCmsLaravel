<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Staff\Entities\StaffCategory;

class ApiStaffCategoryController extends Controller
{
     public function showId($id_category)
     {
       $category = StaffCategory::where('id',$id_category)->firstOrFail();

       return response()->json([
         'category' => $category,
         'staffs' => $category->staffs()->orderBy('created_at', 'asc')->get()
       ]);
     }

     public function showSlug($slug_category)
     {
       $category = StaffCategory::where('slug',$slug_category)->firstOrFail();

       return response()->json([
         'category' => $category,
         'staffs' => [$category->staffs()->orderBy('created_at', 'asc')->get()]
       ]);
     }

    public function index()
    {
      return response()->json(StaffCategory::orderBy('created_at', 'asc')->get());
    }
}
