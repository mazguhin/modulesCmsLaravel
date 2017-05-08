<?php

namespace Modules\Club\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use RoleHelper;
use Settings;
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
    foreach (\App\User::all() as $user){
        if (RoleHelper::checkModer($user))
          $moders->push($user);
    }
    return $moders;
  }

  public function show()
  {
    return view('template::back.'.$this->backTemplate.'.club.show',[
      'clubs' => Club::orderBy('created_at', 'desc')->paginate(10)
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
    $cnews->name = 'Новости';
    $cnews->description = 'Новостная категория клуба '.$club->name;
    $cnews->slug = 'clubcode-'.$club->id.'-news';
    $cnews->role_id = 1;
    $cnews->user_id = $request->user()->id;
    $cnews->club = 1;
    $cnews->save();

    $cinfo = new Category();
    $cinfo->name = 'Информация';
    $cinfo->description = 'Информационная категория клуба '.$club->name;
    $cinfo->slug = 'clubcode-'.$club->id.'-info';
    $cinfo->role_id = 1;
    $cinfo->user_id = $request->user()->id;
    $cinfo->club = 1;
    $cinfo->save();

    $club->cnews_id = $cnews->id;
    $club->cinfo_id = $cinfo->id;

    if ($club->save())
      return redirect()->back()->with([
        'result' => 'Клуб успешно добавлен',
        'club_id' => $club->id
      ]);
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

    if ($club->save())
      return redirect()->back()->with([
        'result' => 'Клуб успешно обновлен',
        'club_id' => $club->id
      ]);
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

    if (str_contains($request->server('HTTP_REFERER'),'dashboard')) {
      // request from dashboard
      return redirect()->back()->with(['result'=>'Клуб успешно удален']);
    } else {
      // request from front
      return redirect('/club')->with(['result'=>'Клуб успешно удален']);
    }
  }

  public function search(Request $request){
      $member = $request->keyword;
      $results = Club::where('name', 'like', "$member%")
          ->orWhere('description', 'like', "$member%")->get();

      return $results;
  }
}
