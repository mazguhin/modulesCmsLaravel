<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Settings;

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
        'users' => \App\User::orderBy('created_at','desc')->limit(10)->get(),
        'categories' => \Modules\Category\Entities\Category::orderBy('created_at','desc')->limit(10)->get(),
        'articles' => \Modules\Article\Entities\Article::orderBy('created_at','desc')->limit(10)->get(),
      ]);
    }
}
