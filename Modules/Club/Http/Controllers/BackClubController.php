<?php

namespace Modules\Club\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use RoleHelper;
use Settings;
use Logs;
use Modules\Club\Entities\Club;
use Modules\Category\Entities\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BackClubController extends Controller
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
      'pay' => 'required'
    ],[
      'name.required' => 'Заполните название',
      'pay.required' => 'Заполните тип',
      'max' => 'Макс. кол-во символов: 255 (Название, Описание)'
    ]));
  }

  public function getModers()
  {
    $moders = collect([]);
    foreach (\App\User::with('role')->get() as $user){
        if (RoleHelper::checkModer($user))
          $moders->push($user);
    }
    return $moders;
  }

  public function show()
  {
    return view('template::back.'.$this->backTemplate.'.club.show',[
      'clubs' => Club::orderBy('created_at', 'desc')->paginate(100)
    ]);
  }

  public function create()
  {
    return view('template::back.'.$this->backTemplate.'.club.create',[
      'moders' => $this->getModers()
    ]);
  }

  public function store(Request $request)
  {
    // validation
    $this->validateForm($request);

    $club = new Club;
    $club->name = $request->name;
    $club->description = $request->description;
    $club->pay = $request->pay;
    $club->save();

    if (isset($request->moders)) {
      foreach($request->moders as $moder) {
        $club->moders()->save(\App\User::findOrFail($moder));
      }
    }

    $cnews = new Category();
    $cnews->name = 'Новости [Club'.$club->name.']';
    $cnews->description = 'Новостная категория клуба ['.$club->name.']';
    $cnews->slug = 'clubcode-'.$club->id.'-news';
    $cnews->role_id = 1;
    $cnews->user_id = $request->user()->id;
    $cnews->club = 1;
    $cnews->save();

    $cinfo = new Category();
    $cinfo->name = 'Информация ['.$club->name.']';
    $cinfo->description = 'Информационная категория клуба '.$club->name;
    $cinfo->slug = 'clubcode-'.$club->id.'-info';
    $cinfo->role_id = 1;
    $cinfo->user_id = $request->user()->id;
    $cinfo->club = 1;
    $cinfo->save();

    $club->cnews_id = $cnews->id;
    $club->cinfo_id = $cinfo->id;

    if ($club->save()) {
      Logs::set('Добавлен клуб ['.$club->name.']');
      return redirect()->back()->with([
        'result' => 'Клуб успешно добавлен',
        'club_id' => $club->id
      ]);
    }
    else
      return redirect()->back()->with('result', 'Возникла ошибка');
  }

  public function editById($id_club)
  {
    return view('template::back.'.$this->backTemplate.'.club.edit',[
      'club' => Club::findOrFail($id_club),
      'moders' => $this->getModers()
    ]);
  }

  public function update(Request $request, $id_club)
  {
    // validation
    $this->validateForm($request);

    $club = Club::findOrFail($id_club);
    $club->name = $request->name;
    $club->description = $request->description;
    $club->pay = $request->pay;

    foreach($club->moders as $moder) {
      $moder->pivot->delete();
    }

    if (isset($request->moders)) {
      foreach($request->moders as $moder) {
        $club->moders()->save(\App\User::findOrFail($moder));
      }
    }

    $club->news->name = 'Новости ['.$club->name.']';
    $club->news->description = 'Новостная категория клуба ['.$club->name.']';
    $club->news->save();
    $club->info->name = 'Информация ['.$club->name.']';
    $club->info->description = 'Информационная категория клуба '.$club->name;
    $club->info->save();

    if ($club->save()) {
      Logs::set('Изменен клуб ['.$club->name.']');
      return redirect()->back()->with([
        'result' => 'Клуб успешно обновлен',
        'club_id' => $club->id
      ]);
    }
    else
      return redirect()->back()->with('result', 'Возникла ошибка');
  }

  public function destroy(Request $request, $club_id)
  {
    $club = Club::where('id',$club_id)->firstOrFail();

    foreach($club->moders as $moder)
      $moder->pivot->delete();

    foreach ($club->info->articles as $article)
      $article->delete();

    foreach ($club->news->articles as $article)
      $article->delete();

    $club->info()->delete();
    $club->news()->delete();
    $club->delete();
    Logs::set('Удален клуб ['.$club->name.']');

    if (str_contains($request->server('HTTP_REFERER'),'dashboard')) {
      // request from dashboard
      return redirect()->back()->with(['result'=>'Клуб успешно удален']);
    } else {
      // request from front
      return redirect('/')->with(['result'=>'Клуб успешно удален']);
    }
  }
}
