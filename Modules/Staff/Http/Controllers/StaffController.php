<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Staff\Entities\Staff;
use Settings;
use RoleHelper;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

     protected $frontTemplate = '';

     public function __construct()
     {
       $this->frontTemplate = Settings::getFrontTemplate();
     }

    public function index()
    {
        return view('staff::index');
    }

    public function showId($id_staff)
    {
      return view('template::front.'.$this->frontTemplate.'.staff.showStaff', [
        'staff' => Staff::where('id',$id_staff)->firstOrFail()
      ]);
    }

    public function showSlug($slug_staff)
    {
      return view('template::front.'.$this->frontTemplate.'.staff.showStaff', [
        'staff' => Staff::where('slug',$slug_staff)->firstOrFail()
      ]);
    }
}
