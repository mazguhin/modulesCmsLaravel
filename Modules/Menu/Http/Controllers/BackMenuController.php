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
     'activated' => 'required|max:255',
   ],[
     'title.required' => 'Заполните заголовок',
     'access.required' => 'Назначьте доступ',
     'max' => 'Макс. кол-во символов: 255'
   ]));
 }

 public function show()
 {
   return view('template::back.'.$this->backTemplate.'.menu.show',[
     'menus' => Menu::orderBy('created_at', 'desc')->paginate(10)
   ]);
 }


 public function create()
 {
   return view('template::back.'.$this->backTemplate.'.menu.create',[
     'articles' => \Modules\Article\Entities\Article::all(),
     'categories' => \Modules\Category\Entities\Category::all(),
     'roles' => \Modules\Dashboard\Entities\Role::all()
   ]);
 }


 public function store(Request $request)
 {

   //validation
   $this->validateForm($request);

   $menu = new Menu();
   $menu->title = $request->title;
   $menu->url = $request->url;
   $menu->icon = $request->icon;
   $menu->description = $request->description;
   $menu->role_id = $request->access;
   $menu->activated = $request->activated;

   if ($menu->save())
     return redirect()->back()->with([
       'result' => 'Меню успешно добавлено'
     ]);
   else
     return redirect()->back()->with('result', 'Возникла ошибка');
 }

 public function editById($id_menu)
 {
   $item = Menu::where('id',$id_menu)->firstOrFail();
   if ($item->url!="") $arrayItemUrl = explode("/",$item->url);
   else
     $arrayItemUrl = array ('','','','');

   return view('template::back.'.$this->backTemplate.'.menu.edit',[
     'arrayItemUrl' => $arrayItemUrl,
     'articles' => \Modules\Article\Entities\Article::all(),
     'categories' => \Modules\Category\Entities\Category::all(),
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
   $menu->url = $request->url;
   $menu->icon = $request->icon;
   $menu->description = $request->description;
   $menu->role_id = $request->access;
   $menu->activated = $request->activated;

   if ($menu->save())
     return redirect()->back()->with([
       'result' => 'Меню успешно обновлено'
     ]);
   else
     return redirect()->back()->with('result', 'Возникла ошибка');
 }


 public function destroy(Request $request, $id_menu)
 {
     $menu = Menu::where('id',$id_menu)->firstOrFail();

     foreach ($menu->menuAllItems() as $item) {
       $item->delete();
     }
     $menu->delete();
     return redirect()->back()->with(['result'=>'Меню успешно удалено']);
  }
}
