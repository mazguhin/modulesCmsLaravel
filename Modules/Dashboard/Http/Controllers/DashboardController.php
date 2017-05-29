<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Settings;
use Modules\Category\Entities\Category;
use Modules\Club\Entities\Club;
use Modules\Article\Entities\Article;
use Modules\Guestbook\Entities\Answer;
use App\User;

class DashboardController extends Controller
{
     protected $backTemplate = '';

     public function __construct()
     {
       $this->backTemplate = Settings::getBackTemplate();
     }

    public function index()
    {
      return view('template::back.'.$this->backTemplate.'.index',[
        'countArticles' => Article::count(),
        'countUsers' => User::count(),
        'countAnswers' => Answer::count(),
        'countClubs' => Club::count(),
        'users' => User::orderBy('created_at','desc')->limit(10)->with('role')->get(),
        'categories' => Category::orderBy('created_at','desc')->where('club',false)->limit(10)->with('user')->get(),
        'articles' => Article::orderBy('created_at','desc')->limit(10)->with('user', 'category')->get(),
      ]);
    }
}
