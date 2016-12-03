<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Setting;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Settings;

class SettingController extends Controller
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
      return view('template::back.'.$this->backTemplate.'.setting.show',[
        'settings' => Setting::all()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('setting::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('setting::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
      $this->validate($request, [
        'frontTemplate' => 'required|max:255',
        'backTemplate' => 'required|max:255',
      ],[
        'required' => 'Заполните все поля',
      ]);

      foreach ($request->all() as $setting => $value)
      {
          if($set = Setting::where('name', $setting)->first())
          {
            $set->value=$value;
            $set->save();
          }
      }

      return redirect()->back()->with(['result' => 'Настройки успешно обновлены']);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
