<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use RoleHelper;
use Settings;
use Modules\Category\Entities\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BackCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

     use ValidatesRequests;

     protected $backTemplate = '';

     public function __construct()
     {
       $this->backTemplate = Settings::getBackTemplate();
     }

    public function index()
    {
    }

    public function validateForm(Request $request)
    {
      return($this->validate($request, [
        'name' => 'required|max:255',
        'description' => 'max:255',
        'role' => 'required|max:255',
      ],[
        'name.required' => 'Заполните название',
        'role.required' => 'Назначьте доступ',
        'max' => 'Макс. кол-во символов: 255 (Название, Описание)'
      ]));
    }

    public function show()
    {
      return view('template::back.'.$this->backTemplate.'.category.show',[
        'categories' => Category::orderBy('created_at', 'desc')->paginate(10)
      ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      return view('template::back.'.$this->backTemplate.'.category.create',[
        'roles' => \Modules\Dashboard\Entities\Role::all()
      ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      // validation
      $this->validateForm($request);

      $category = new Category;
      $category->name = $request->name;
      $category->description = $request->description;
      $category->role_id = $request->role;

      // generation slug
      $slug = str_slug($request->name);
      if (Category::where('slug', $slug)->count()>0)
        $category->slug = $slug.'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s');
      else
        $category->slug = $slug;

      if ($request->user()->categories()->save($category))
        return redirect()->back()->with([
          'result' => 'Категория успешно добавлена',
          'slug' => $slug
        ]);
      else
        return redirect()->back()->with('result', 'Возникла ошибка');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */

    public function editById($id_category)
    {
      return view('template::back.'.$this->backTemplate.'.category.edit',[
        'roles' => \Modules\Dashboard\Entities\Role::all(),
        'category' => Category::where('id',$id_category)->firstOrFail()
      ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
     public function update(Request $request, $id_category)
     {
       // validation
       $this->validateForm($request);

       $category = Category::where('id',$id_category)->firstOrFail();
       $category->name = $request->name;
       $category->description = $request->description;
       $category->role_id = $request->role;

       // generation slug
       $slug = str_slug($request->name);
       if ($slug!=$category->slug) {
         if (Category::where('slug', $slug)->count()>0)
           $category->slug = $slug.'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s');
         else
          $category->slug = $slug;
       }

       if ($category->save())
         return redirect()->back()->with([
           'result' => 'Категория успешно обновлена',
           'slug' => $category->slug
         ]);
       else
         return redirect()->back()->with('result', 'Возникла ошибка');
     }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */

    public function destroy(Request $request, $id_category)
    {
      $category = Category::where('id',$id_category)->firstOrFail();
      foreach ($category->articles as $article) {
        $article->delete();
      }
      $category->delete();

      if (str_contains($request->server('HTTP_REFERER'),'dashboard')) {
        // request from dashboard
        return redirect()->back()->with(['result'=>'Категория успешно удалена']);
      } else {
        // request from front
        return redirect('/category')->with(['result'=>'Категория успешно удалена']);
      }
    }
}
