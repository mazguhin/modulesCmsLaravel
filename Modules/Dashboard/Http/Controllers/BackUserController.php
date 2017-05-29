<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Settings;
use App\User;
use Logs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BackUserController extends Controller
{
     use ValidatesRequests;

     protected $backTemplate = '';

     public function __construct()
     {
       $this->backTemplate = Settings::getBackTemplate();
     }

    public function show()
    {
      return view('template::back.'.$this->backTemplate.'.user.show',[
        'users' => User::orderBy('created_at', 'desc')->with('role')->paginate(100)
      ]);
    }

    public function create()
    {
      return view('template::back.'.$this->backTemplate.'.user.create',[
        'roles' => \Modules\Dashboard\Entities\Role::where('permission','>',1)->get()
      ]);
    }

    public function store(Request $request)
    {
      // validation
      $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'max:255|required|email|unique:users',
        'password' => 'min:6|required|max:255',
        'role' => 'max:255|required',
      ],[
        'required' => 'Заполните все поля',
        'max' => 'Макс. кол-во символов - 255 символов',
        'email' => 'Введите корректный e-mail',
        'min' => 'Минимальная длина пароля - 6 символов',
        'unique' => 'Данный e-mail уже используется',
      ]);

      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->role_id = $request->role;

      if ($user->save()) {
        Logs::set('Добавлен пользователь ['.$user->name.'] ['.$user->email.']');
        return redirect()->back()->with([
          'result' => 'Пользователь успешно добавлен',
          'user_id' => $user->id
        ]);
      }
      else
      return redirect()->back()->with('result', 'Возникла ошибка');
    }

    public function editById($id_user)
    {
      return view('template::back.'.$this->backTemplate.'.user.edit',[
        'roles' => \Modules\Dashboard\Entities\Role::where('permission','>',1)->get(),
        'user' => User::where('id',$id_user)->firstOrFail()
      ]);
    }

     public function update(Request $request, $id_user)
     {
       // validation
       $this->validate($request, [
         'name' => 'required|max:255',
         'email' => 'max:255|required|email',
         'role' => 'max:255|required',
       ],[
         'required' => 'Заполните все поля',
         'max' => 'Макс. кол-во символов - 255 символов',
         'email' => 'Введите корректный e-mail',
         'min' => 'Минимальная длина пароля - 6 символов',
       ]);

       $user = User::where('id',$id_user)->firstOrFail();
       $user->name = $request->name;
       $user->email = $request->email;
       $user->role_id = $request->role;

       if ($user->save()) {
         Logs::set('Изменен пользователь ['.$user->name.'] ['.$user->email.']');
         return redirect()->back()->with([
           'result' => 'Пользователь успешно обновлен',
          //  'user_id' => $user->id
         ]);
       }
       else
         return redirect()->back()->with('result', 'Возникла ошибка');
     }

     public function updatePassword(User $user, Request $request)
     {
       $this->validate($request, [
         'password' => 'required|min:6|confirmed',
       ],
       [
         'confirmed' => 'Пароли не совпадают',
         'min' => 'Минимальное кол-во знаков: 6'
       ]);

       $user->password = bcrypt($request->password);
       $user->save();
       Logs::set('Изменен пароль пользователя ['.$user->name.'] ['.$user->email.']');
       return back()->with(['result'=>'Пароль успешно изменен']);
     }

    public function ban(Request $request, $id_user)
    {
      if ($id_user==1) return redirect()->back()->with('result', 'Невозможно заблокировать данного пользователя');

      $user = User::where('id',$id_user)->firstOrFail();

      $role = \Modules\Dashboard\Entities\Role::where('permission',0)->firstOrFail()->id;

      $user->role_id=$role;

      if ($user->save()) {
        Logs::set('Заблокирован пользователь ['.$user->name.'] ['.$user->email.']');
        return redirect()->back()->with(['result' => 'Пользователь успешно заблокирован']);
      }
      else
        return redirect()->back()->with('result', 'Возникла ошибка');
    }

    public function unban(Request $request, $id_user)
    {
      $user = User::where('id',$id_user)->firstOrFail();

      $role = \Modules\Dashboard\Entities\Role::where('permission',2)->firstOrFail()->id;

      $user->role_id=$role;

      if ($user->save()) {
        Logs::set('Разблокирован пользователь ['.$user->name.'] ['.$user->email.']');
        return redirect()->back()->with(['result' => 'Пользователь успешно разблокирован']);
      }
      else
        return redirect()->back()->with('result', 'Возникла ошибка');
    }
}
