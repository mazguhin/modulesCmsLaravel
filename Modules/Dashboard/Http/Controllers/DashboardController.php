<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Settings;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

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

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
