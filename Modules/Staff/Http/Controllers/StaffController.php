<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Staff\Entities\Staff;
use Settings;

class StaffController extends Controller
{
     protected $frontTemplate = '';

     public function __construct()
     {
       $this->frontTemplate = Settings::getFrontTemplate();
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
