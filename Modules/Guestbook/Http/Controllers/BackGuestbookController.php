<?php

namespace Modules\Guestbook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Settings;
use Modules\Guestbook\Entities\Question;
use Modules\Guestbook\Entities\Answer;

class BackGuestbookController extends Controller
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
      'body' => 'required',
    ],[
      'body.required' => 'Заполните ответ',
    ]));
  }

  public function index()
  {
    return view('template::back.'.$this->backTemplate.'.guestbook.index',[
      'questions' => Question::where('answer_id','0')->orderBy('created_at','desc')->paginate(10),
    ]);
  }

  public function show(Question $question)
  {
    return view('template::back.'.$this->backTemplate.'.guestbook.show',[
      'question' => $question
    ]);
  }

  public function setAnswer(Question $question)
  {
    $this->validateForm(request());

    $answer = new Answer();
    $answer->user_id = request()->user()->id;
    $answer->body = request('body');
    $answer->save();
    $question->answer_id = $answer->id;
    $question->save();

    return redirect('/dashboard/guestbook')->with(['result'=>'Ответ успешно добавлен']);
  }

  public function edit(Question $question)
  {
    return view('template::back.'.$this->backTemplate.'.guestbook.edit',[
      'question' => $question
    ]);
  }

  public function save(Question $question)
  {
    $this->validateForm(request());
    
    $question->answer->body = request('body');
    $question->answer->user_id = request()->user()->id;
    $question->answer->save();

    return redirect('/guestbook')->with(['result'=>'Ответ успешно изменен']);
  }

  public function delete(Question $question)
  {
    if (null!==$question->answer) {
      $question->answer->delete();
    }

    $question->delete();
    return back()->with(['result'=>'Ответ успешно удален']);
  }
}
