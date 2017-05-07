<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Staff\Entities\Staff;
//use Settings;
//use RoleHelper;

class ApiStaffController extends Controller
{
    public function showId($id_staff)
    {
      return response()->json(Staff::where('id',$id_staff)->firstOrFail());
    }

    public function showSlug($slug_staff)
    {
      return response()->json(Staff::where('slug',$slug_staff)->firstOrFail());
    }
}
