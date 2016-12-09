<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Settings;
use Auth;

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
      return view('template::front.'.$this->frontTemplate.'.user.profile', [
        'user' => Auth::user()
      ]);
    }
}
