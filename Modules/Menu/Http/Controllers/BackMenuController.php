<?php

namespace Modules\Menu\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Menu\Entities\Menu;
use Settings;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BackMenuController extends Controller
{
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
   return ($this->validate($request, [
     'title' => 'required|max:255',
     'description' => 'max:255',
     'access' => 'required|max:255',
     'role' => 'required|max:255',
     'activated' => 'required|max:255',
   ],[
     'title.required' => 'Заполните заголовок',
     'access.required' => 'Назначьте доступ',
     'role.required' => 'Назначьте роль',
     'max' => 'Макс. кол-во символов: 255'
   ]));
 }

 public function show()
 {
   return view('template::back.'.$this->backTemplate.'.menu.show',[
     'menus' => Menu::orderBy('created_at', 'desc')->paginate(10)
   ]);
 }

 // WAIT
 public function create()
 {
   return 'В РАЗРАБОТКЕ';

   return view('template::back.'.$this->backTemplate.'.article.create',[
     'categories' => \Modules\Category\Entities\Category::all(),
     'roles' => \Modules\Dashboard\Entities\Role::all()
   ]);
 }

 //  WAIT
 public function store(Request $request)
 {
   return 'В РАЗРАБОТКЕ';

   //validation
   $this->validateForm($request);

   $article = new Article;
   $article->title = $request->title;
   $article->description = $request->description;
   $article->body = $request->editor;
   $article->role_id = $request->role;
   $article->category_id = $request->category;

   // generation slug
   if (empty($request->slug)) $slug=str_slug($request->title);
     else $slug = $request->slug;

   if (Article::where('slug', $slug)->count()>0)
     $article->slug = $slug.'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s');
   else
     $article->slug = $slug;

   if ($request->user()->articles()->save($article))
     return redirect()->back()->with([
       'result' => 'Статья успешно добавлена',
       'slug' => $slug
     ]);
   else
     return redirect()->back()->with('result', 'Возникла ошибка');
 }

 public function editById($id_menu)
 {
   return view('template::back.'.$this->backTemplate.'.menu.edit',[
     'menu' => Menu::where('id',$id_menu)->firstOrFail(),
     'roles' => \Modules\Dashboard\Entities\Role::all()
   ]);
 }

 public function update(Request $request, $id_menu)
 {
   // validation
   $this->validateForm($request);

   $menu = Menu::where('id',$id_menu)->firstOrFail();
   $menu->title = $request->title;
   $menu->description = $request->description;
   $menu->role = $request->role;
   $menu->role_id = $request->access;
   $menu->activated = $request->activated;

   if ($menu->save())
     return redirect()->back()->with([
       'result' => 'Меню успешно обновлено'
     ]);
   else
     return redirect()->back()->with('result', 'Возникла ошибка');
 }


 // WAIT
 public function destroy(Request $request, $id_article)
 {
   return 'В РАЗРАБОТКЕ';

   // check start page
   $arrayFromStartPageString = explode("/",Settings::get('startPage'));
   if ($arrayFromStartPageString[1]!='article')
     $arrayFromStartPageString[3]=0;

   if ($arrayFromStartPageString[3]==$id_article)
     return redirect()->back()->with(['result'=>'Нельзя удалить главную страницу']);

   $article = Article::where('id',$id_article)->firstOrFail();
   if (str_contains($request->server('HTTP_REFERER'),'dashboard')) {
     // request from dashboard
     $article->delete();
     return redirect()->back()->with(['result'=>'Статья успешно удалена']);
   } else {
     // request from front
     $category = $article->category->id;
     $article->delete();
     return redirect('/category/id/'.$category)->with(['result'=>'Статья успешно удалена']);
   }
 }
}
