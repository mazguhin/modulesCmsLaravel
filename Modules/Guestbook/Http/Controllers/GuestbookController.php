<?php

namespace Modules\Guestbook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Settings;
use Logs;
use Modules\Guestbook\Entities\Question;
use Modules\Guestbook\Entities\Answer;

class GuestbookController extends Controller
{
  protected $frontTemplate = '';

  public function __construct()
  {
    $this->frontTemplate = Settings::getFrontTemplate();
  }

  public function index()
  {
    return view ('template::front.'.$this->frontTemplate.'.guestbook.index', [
      'answers' => Answer::orderBy('created_at','desc')->with('question.user')->paginate(10),
    ]);
  }

  public function store()
  {
    $question = request()->user()->questions()->create([
      'body' => request('body')
    ]);

    Logs::set('Добавлен вопрос [ID: '.$question->id.']');
    return redirect()->back()->with('result', 'Вопрос успешно добавлен и будет опубликован после проверки администрацией');
  }
}
