<?php

namespace Modules\Menu\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\MenuItem;
use Settings;
use Logs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BackMenuItemController extends Controller
{
  use ValidatesRequests;

  protected $backTemplate = '';

  public function __construct()
  {
    $this->backTemplate = Settings::getBackTemplate();
  }

 public function validateForm(Request $request)
 {
   return ($this->validate($request, [
     'title' => 'required|max:255',
     'description' => 'max:255',
     'url' => 'required|max:255',
     'role' => 'required|max:255',
     'target' => 'required|max:255',
     'activated' => 'required|max:255',
   ],[
     'required' => 'Заполните все обязательные поля (*)',
     'max' => 'Макс. кол-во символов: 255'
   ]));
 }

 public function show($id_menu)
 {
   return view('template::back.'.$this->backTemplate.'.menu.item.show',[
     'items' => Menu::where('id',$id_menu)->firstOrFail()->menuAllItems()->with('role')->get(),
     'id_menu' => $id_menu,
   ]);
 }

 public function create($id_menu)
 {
   $articles = collect([]);
   foreach (\Modules\Article\Entities\Article::all() as $article) {
     if ($article->category->club==false) $articles->push($article);
   }

   return view('template::back.'.$this->backTemplate.'.menu.item.create',[
     'articles' => $articles,
     'categories' => \Modules\Category\Entities\Category::where('club',false)->get(),
     'clubs' => \Modules\Club\Entities\Club::all(),
     'staffCategories' => \Modules\Staff\Entities\StaffCategory::all(),
     'roles' => \Modules\Dashboard\Entities\Role::all(),
     'id_menu' => $id_menu,
   ]);
 }

 public function store(Request $request, $id_menu)
 {
   //validation
   $this->validateForm($request);

   $itemMenu = new MenuItem;
   $itemMenu->title = $request->title;
   $itemMenu->description = $request->description;
   $itemMenu->role_id = $request->role;
   $itemMenu->activated = $request->activated;
   $itemMenu->url = $request->url;
   $itemMenu->target = $request->target;

   if (Menu::where('id',$id_menu)->firstOrFail()->menuAllItems()->save($itemMenu)) {
     Logs::set('Добавлен пункт меню ['.$itemMenu->title.']');
     return redirect('/dashboard/menu/item/id/'.$id_menu)->with([
       'result' => 'Пункт меню успешно добавлен'
     ]);
   }
   else
     return redirect()->back()->with('result', 'Возникла ошибка');
 }

 public function editById($id_item)
 {
   $item = MenuItem::where('id',$id_item)->firstOrFail();
   $arrayItemUrl = explode("/",$item->url);

   $articles = collect([]);
   foreach (\Modules\Article\Entities\Article::with('category')->get() as $article) {
     if ($article->category->club==false) $articles->push($article);
   }

   return view('template::back.'.$this->backTemplate.'.menu.item.edit',[
     'item' => $item,
     'id_menu' => $item->menu->id,
     'arrayItemUrl' => $arrayItemUrl,
     'articles' => $articles,
     'categories' => \Modules\Category\Entities\Category::where('club',false)->get(),
     'clubs' => \Modules\Club\Entities\Club::all(),
     'staffCategories' => \Modules\Staff\Entities\StaffCategory::all(),
     'roles' => \Modules\Dashboard\Entities\Role::all(),
   ]);
 }

 public function update(Request $request, $id_item)
 {
   // validation
   $this->validateForm($request);

   $itemMenu = MenuItem::where('id',$id_item)->firstOrFail();
   $itemMenu->title = $request->title;
   $itemMenu->description = $request->description;
   $itemMenu->role_id = $request->role;
   $itemMenu->activated = $request->activated;
   $itemMenu->url = $request->url;
   $itemMenu->target = $request->target;

   if ($itemMenu->save()) {
     Logs::set('Изменен пункт меню ['.$itemMenu->title.']');
     return redirect()->back()->with([
       'result' => 'Меню успешно обновлено'
     ]);
   }
   else
     return redirect()->back()->with('result', 'Возникла ошибка');
 }

 public function destroy(Request $request, $id_item)
 {
   $itemMenu = MenuItem::where('id',$id_item)->firstOrFail();

   if ($itemMenu->required==1)
    return redirect()->back()->with(['result'=>'Нельзя удалить обязательный пункт меню']);

     if ($itemMenu->delete()) {
       Logs::set('Удален пункт меню ['.$itemMenu->title.']');
       return redirect()->back()->with('result', 'Пункт меню успешно удален');
      }
     else
      return redirect()->back()->with('result', 'Возникла ошибка');
 }
}
