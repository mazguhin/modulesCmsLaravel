<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Setting;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Settings;
use Logs;

class SettingController extends Controller
{
     use ValidatesRequests;

     protected $backTemplate = '';

     public function __construct()
     {
       $this->backTemplate = Settings::getBackTemplate();
     }

    public function index()
    {
      // получаем корень нашего сайта в файловой системе
      $mainPath = explode('Modules'  , __DIR__)[0];

      $backTemplates = scandir ($mainPath.'Modules/Template/Resources/views/back');
      $backTemplatesCollection = collect([]);
      for ($i = count($backTemplates)-1; $i>=2; $i--)
        $backTemplatesCollection->push($backTemplates[$i]);

      $frontTemplates = scandir ($mainPath.'Modules/Template/Resources/views/front');
      $frontTemplatesCollection = collect([]);
      for ($i = count($frontTemplates)-1; $i>=2; $i--)
          $frontTemplatesCollection->push($frontTemplates[$i]);


      return view('template::back.'.$this->backTemplate.'.setting.show',[
        'settings' => Setting::all(),
        'frontTemplates' => $frontTemplatesCollection,
        'backTemplates' => $backTemplatesCollection
      ]);
    }

    public function update(Request $request)
    {
      $this->validate($request, [
        'frontTemplate' => 'required|max:255',
        'backTemplate' => 'required|max:255',
        'projectName' => 'required|max:20',
        'displayErrorsBlocks' => 'required|max:20',
      ],[
        'required' => 'Заполните все поля',
        'max' => 'Превышен допустимый лимит символов',
      ]);

      foreach ($request->all() as $setting => $value)
      {
          if($set = Setting::where('name', $setting)->first())
          {
            $set->value=$value;
            $set->save();
          }
      }

      Logs::set('Изменены настройки системы');
      return redirect()->back()->with(['result' => 'Настройки успешно обновлены']);
    }

    public function setStartPage(Request $request, $id=1)
    {
      $this->validate($request, [
        'type' => 'required|max:255'
      ],[
        'required' => 'Заполните все поля',
      ]);

      $type = $request->type;

      $startPage = Setting::where('name','startPage')->firstOrFail();
      $startPage->value='/'.$type.'/id/'.$id;

      if ($startPage->save()) {
        Logs::set('Изменена главная страница');
        return redirect()->back()->with(['result' => 'Главная страница установлена']);
      }
    }
}
