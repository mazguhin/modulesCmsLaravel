<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class TemplateController extends Controller
{
    public function index()
    {
        return view('template::front.amy.layouts.main');
    }
}
