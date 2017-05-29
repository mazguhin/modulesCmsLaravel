<?php

namespace Modules\Club\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Settings;
use Modules\Club\Entities\Club;
use Modules\Category\Entities\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ClubController extends Controller
{
  protected $frontTemplate = '';

  public function __construct()
  {
    $this->frontTemplate = Settings::getFrontTemplate();
  }

  public function index($id_club)
  {
    $club = Club::findOrFail($id_club);

    return view('template::front.'.$this->frontTemplate.'.club.show', [
      'club' => $club,
      'articles' => $club->news->articles()->with('user')->orderBy('created_at', 'desc')->paginate(5),
      'pages' => $club->info->articles()->orderBy('created_at', 'desc')->get(),
    ]);
  }

}
