<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use Settings;
use Auth;
use Modules\Log\Entities\Log;
use Logs;

class HomeController extends Controller
{

    protected $frontTemplate = '';

    public function __construct()
    {
        $this->middleware('auth');
        $this->frontTemplate = Settings::getFrontTemplate();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
      $user = Auth::user();
      return view('template::front.'.$this->frontTemplate.'.user.profile', [
        'user' => $user,
        'logs' => \Modules\Log\Entities\Log::where('user_id', $user->id)->latest()->paginate(10),
      ]);
    }

    public function updatePassword(Request $request)
    {
      $this->validate($request, [
        'password' => 'required|min:6|confirmed',
      ],
      [
        'confirmed' => 'Пароли не совпадают',
        'min' => 'Минимальное кол-во знаков: 6'
      ]);

      $user = Auth::user();
      $user->password = bcrypt($request->password);
      $user->save();
      Logs::set('Изменен пароль аккаунта');
      return back()->with(['result'=>'Пароль успешно изменен']);
    }

    public function updateAvatar(Request $request)
    {
      if ($request->photo!='') {
        $user = Auth::user();
        $file = $request->file('photo');
        $ext = $file->extension();
        Storage::delete($user->photo);
        $user->photo = $file->storeAs('public/user','avatar-'.$user->id.'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s').'.'.$ext);
        $user->save();
        Logs::set('Изменен аватар аккаунта');
        return back()->with(['result'=>'Аватар успешно обновлен']);
      }

      return back()->with(['result'=>'Изображение не выбрано']);
    }
}
