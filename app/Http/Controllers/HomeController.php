<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Settings;
use Auth;
use Modules\Log\Entities\Log;

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
      $user = Auth::user();
      return view('template::front.'.$this->frontTemplate.'.user.profile', [
        'user' => $user,
        'logs' => \Modules\Log\Entities\Log::where('user_id', $user->id)->latest()->paginate(10),
      ]);
    }
}
