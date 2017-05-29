<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Settings;
use Logs;
use Modules\Category\Entities\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Cache;

class BackCategoryController extends Controller
{
     use ValidatesRequests;

     protected $backTemplate = '';

     public function __construct()
     {
       $this->backTemplate = Settings::getBackTemplate();
     }

    public function validateForm(Request $request)
    {
      return($this->validate($request, [
        'name' => 'required|max:255',
        'description' => 'max:255',
        'role' => 'required|max:255',
        'slug' => 'max:255',
      ],[
        'name.required' => 'Заполните название',
        'role.required' => 'Назначьте доступ',
        'max' => 'Макс. кол-во символов: 255 (Название, Описание, URL)'
      ]));
    }

    public function getStartPage()
    {
      // /{type}/id/{id}
      // [1] - type (article/category etc.)
      // [3] - id
      return explode("/",Settings::get('startPage'));
    }

    public function show()
    {
      $startPage = $this->getStartPage();
      if ($startPage[1]!='category')
        $startPage[3] = 0;

      return view('template::back.'.$this->backTemplate.'.category.show',[
        'categories' => Category::where('club',false)->orderBy('created_at', 'desc')->paginate(100),
        'startPageId' => $startPage[3]
      ]);
    }

    public function create()
    {
      return view('template::back.'.$this->backTemplate.'.category.create',[
        'roles' => \Modules\Dashboard\Entities\Role::all()
      ]);
    }

    public function store(Request $request)
    {
      // validation
      $this->validateForm($request);

      $category = new Category;
      $category->name = $request->name;
      $category->description = $request->description;
      $category->role_id = $request->role;

      // generation slug
      if (empty($request->slug)) $slug=str_slug($request->name);
        else $slug = $request->slug;

      if (Category::where('slug', $slug)->count()>0)
        $category->slug = $slug.'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s');
      else
        $category->slug = $slug;

      if ($request->user()->categories()->save($category)) {

        Logs::set('Добавлена категория ['.$category->title.']');
        return redirect()->back()->with([
          'result' => 'Категория успешно добавлена',
          'slug' => $slug
        ]);
      }
      else
        return redirect()->back()->with('result', 'Возникла ошибка');
    }

    public function editById($id_category)
    {
      return view('template::back.'.$this->backTemplate.'.category.edit',[
        'roles' => \Modules\Dashboard\Entities\Role::all(),
        'category' => Category::where('id',$id_category)->firstOrFail()
      ]);
    }

     public function update(Request $request, $id_category)
     {
       // validation
       $this->validateForm($request);

       $category = Category::where('id',$id_category)->firstOrFail();
       $category->name = $request->name;
       $category->description = $request->description;
       $category->role_id = $request->role;

       // generation slug
       if (empty($request->slug)) $slug=str_slug($request->name);
         else $slug = $request->slug;

       if ($slug!=$category->slug) {
         if (Category::where('slug', $slug)->count()>0)
           $category->slug = $slug.'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s');
         else
          $category->slug = $slug;
       }

       if ($category->save()) {
         Cache::forget('category.'.$category->id);
         Logs::set('Изменена категория ['.$category->title.']');
         return redirect()->back()->with([
           'result' => 'Категория успешно обновлена',
           'slug' => $category->slug
         ]);
       }
       else
         return redirect()->back()->with('result', 'Возникла ошибка');
     }

    public function destroy(Request $request, $id_category)
    {
      $startPage = $this->getStartPage();

      // if this start page (category)
      if ($startPage[1]=='category' && $startPage[3]==$id_category)
        return redirect()->back()->with(['result'=>'Нельзя удалить главную страницу']);

      $category = Category::where('id',$id_category)->firstOrFail();
      $articles = $category->articles;

      // if this start page (article)
      if ($startPage[1]=='article' && count($articles->where('id',$startPage[3])->first())>0)
        return redirect()->back()->with(['result'=>'Нельзя удалить категорию, содержащую в себе статью на главной странице']);

      foreach ($articles as $article) {
        $article->delete();
      }
      $category->delete();
      Logs::set('Удалена категория ['.$category->title.']');

      if (str_contains($request->server('HTTP_REFERER'),'dashboard')) {
        // request from dashboard
        return redirect()->back()->with(['result'=>'Категория успешно удалена']);
      } else {
        // request from front
        return redirect('/category')->with(['result'=>'Категория успешно удалена']);
      }
    }
}
