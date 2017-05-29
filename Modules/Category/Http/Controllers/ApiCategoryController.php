<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Settings;
use RoleHelper;

class ApiCategoryController extends Controller
{
     public function showId($id_category)
     {
       $category = Category::where('id',$id_category)->firstOrFail();

       // validation permission for this page
       if (!RoleHelper::validatePermissionForPage($category->role->permission))
         return response('Отказано в доступе',403);

       return response()->json([
         'category' => $category,
         'articles' => $category->articles()->orderBy('created_at', 'desc')->get()
       ]);
     }

     public function showSlug($slug_category)
     {
       $category = Category::where('slug',$slug_category)->firstOrFail();

       // validation permission for this page
       if (!RoleHelper::validatePermissionForPage($category->role->permission))
         return response('Отказано в доступе',403);

      return response()->json([
       'category' => $category,
       'articles' => $category->articles()->orderBy('created_at', 'desc')->get()
     ]);
     }

    public function index()
    {
      return response()->json(
        Category::orderBy('created_at', 'desc')->get()
      );
    }
}
