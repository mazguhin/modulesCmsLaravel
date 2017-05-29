<?php

namespace Modules\Block\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Settings;
use Logs;
use Modules\Block\Entities\Block;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Cache;

class BackBlockController extends Controller
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
     'description' => 'required|max:255',
     'editor' => 'required',
     'role' => 'required|max:255',
   ],[
     'description.required' => 'Заполните описание',
     'editor.required' => 'Заполните текст блока',
     'role.required' => 'Назначьте доступ',
     'max' => 'Макс. кол-во символов: 255 (Описание)'
   ]));
 }

 public function show()
 {
   return view('template::back.'.$this->backTemplate.'.block.show',[
     'blocks' => Block::orderBy('created_at', 'desc')->paginate(100),
   ]);
 }

 public function create()
 {
   return view('template::back.'.$this->backTemplate.'.block.create',[
     'roles' => \Modules\Dashboard\Entities\Role::all()
   ]);
 }

 public function store(Request $request)
 {
   //validation
   $this->validateForm($request);

   $block = new Block;
   $block->description = $request->description;
   $block->body = $request->editor;
   $block->role_id = $request->role;

   if ($block->save()) {
     Logs::set('Добавлен блок [ID: '.$block->id.']');
     return redirect()->back()->with([
       'result' => 'Блок успешно добавлен [ID: '.$block->id.']',
     ]);
   }
   else
     return redirect()->back()->with('result', 'Возникла ошибка');
 }

 public function edit(Block $block)
 {
   return view('template::back.'.$this->backTemplate.'.block.edit',[
     'block' => $block,
     'roles' => \Modules\Dashboard\Entities\Role::all()
   ]);
 }

 public function update(Request $request, Block $block)
 {
   // validation
   $this->validateForm($request);

   $block->description = $request->description;
   $block->body = $request->editor;
   $block->role_id = $request->role;

   if ($block->save()) {
     Cache::forget('block.'.$block->id);
     Logs::set('Изменен блок [ID: '.$block->id.']');
     return redirect()->back()->with([
       'result' => 'Блок успешно обновлен',
     ]);
   }
   else
     return redirect()->back()->with('result', 'Возникла ошибка');
 }

 public function destroy(Request $request, $block)
 {
   $block = Block::where('id',$block)->firstOrFail();
   $block->delete();
   Logs::set('Удален блок [ID: '.$block->id.']');
   return redirect()->back()->with(['result'=>'Блок успешно удален']);
 }
}
