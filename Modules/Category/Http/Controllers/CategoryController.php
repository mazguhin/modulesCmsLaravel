<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Settings;
use RoleHelper;
use Cache;

class CategoryController extends Controller
{
     protected $frontTemplate = '';

     public function __construct()
     {
       $this->frontTemplate = Settings::getFrontTemplate();
     }

     public function show($category)
     {
       if (!RoleHelper::validatePermissionForPage($category->role->permission))
         return view('template::front.'.$this->frontTemplate.'.category.accsesDenied');

       return view('template::front.'.$this->frontTemplate.'.category.showCategory', [
         'category' => $category,
         'articles' => $category->articles()->orderBy('created_at', 'desc')->paginate(5)
       ]);
     }

     public function showId($id_category)
     {
       return $this->show(Cache::get('category.'.$id_category, function() use ($id_category) {
         $tmpCategory = Category::where('id',$id_category)->firstOrFail();
         Cache::add('category.'.$id_category, $tmpCategory, 30); // cache 30 min
         return $tmpCategory;
       }));   
     }

     public function showSlug($slug_category)
     {
       return $this->show(Category::where('slug',$slug_category)->firstOrFail());
     }

    public function index()
    {
      return view('template::front.'.$this->frontTemplate.'.category.index', [
        'categories' => Category::orderBy('created_at', 'desc')->paginate(5)
      ]);
    }
}
