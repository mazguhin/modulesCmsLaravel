<?php

namespace Modules\Block\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Settings;
use Modules\Block\Entities\Block;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BackBlockController extends Controller
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
     'blocks' => Block::orderBy('created_at', 'desc')->paginate(10),
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

   if ($block->save())
     return redirect()->back()->with([
       'result' => 'Блок успешно добавлен [ID: '.$block->id.']',
     ]);
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

   if ($block->save())
     return redirect()->back()->with([
       'result' => 'Блок успешно обновлен',
     ]);
   else
     return redirect()->back()->with('result', 'Возникла ошибка');
 }

 public function destroy(Request $request, $block)
 {
   $block = Block::where('id',$block)->firstOrFail();
   $block->delete();
   return redirect()->back()->with(['result'=>'Блок успешно удален']);
 }
}