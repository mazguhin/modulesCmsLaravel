<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Settings;
use Modules\Staff\Entities\Staff;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;

class BackStaffController extends Controller
{
     use ValidatesRequests;

     protected $backTemplate = '';

     public function __construct()
     {
       $this->backTemplate = Settings::getBackTemplate();
     }

    public function validateForm(Request $request)
    {
      return ($this->validate($request, [
        'fullName' => 'required|max:255',
        'position' => 'max:255',
        'disciplines' => 'required|max:255',
        'academicDegree' => 'max:255',
        'academicTitle' => 'max:255',
        'specialty' => 'required|max:255',
        'training' => 'max:255',
        'generalExperience' => 'required|max:255',
        'specialtyExperience' => 'required|max:255',
        'photo' => 'max:255',
        'category' => 'required|max:255',
        'slug' => 'max:255',
      ],[
        'required' => 'Заполните обязательные поля',
        'max' => 'Макс. кол-во символов: 255 (Заголовок, Описание, URL)'
      ]));
    }

    public function show()
    {
      return view('template::back.'.$this->backTemplate.'.staff.show',[
        'staffs' => Staff::orderBy('created_at', 'desc')->paginate(100)
      ]);
    }

    public function create()
    {
      return view('template::back.'.$this->backTemplate.'.staff.create',[
        'categories' => \Modules\Staff\Entities\StaffCategory::all()
      ]);
    }


    public function store(Request $request)
    {
      //validation
      $this->validateForm($request);

      $staff = new Staff;
      $staff->fullName = $request->fullName;
      $staff->position = $request->position;
      $staff->disciplines = $request->disciplines;
      $staff->academicDegree = $request->academicDegree;
      $staff->academicTitle = $request->academicTitle;
      $staff->specialty = $request->specialty;
      $staff->training = $request->training;
      $staff->generalExperience = $request->generalExperience;
      $staff->specialtyExperience = $request->specialtyExperience;
      $staff->user_id = $request->user()->id;

      // generation slug
      if (empty($request->slug)) $slug=str_slug($request->fullName);
        else $slug = $request->slug;

      if (Staff::where('slug', $slug)->count()>0)
        $staff->slug = $slug.'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s');
      else
        $staff->slug = $slug;

        if ($request->photo!='') {
          $file = $request->file('photo');
          $ext = $file->extension();
          $staff->photo = $file->storeAs('public/staff','avatar-'.str_slug($request->fullName).'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s').'.'.$ext);
        }

      foreach($request->category as $cat) {
        \Modules\Staff\Entities\StaffCategory::findOrFail($cat)->staffs()->save($staff);
      }

        return redirect()->back()->with([
          'result' => 'Сотрудник успешно добавлен',
          'slug' => $slug
        ]);
    }

    public function editById($id_staff)
    {
      return view('template::back.'.$this->backTemplate.'.staff.edit',[
        'categories' => \Modules\Staff\Entities\StaffCategory::all(),
        'staff' => Staff::where('id',$id_staff)->firstOrFail()
      ]);
    }

    public function update(Request $request, $id_staff)
    {
      //validation
      $this->validateForm($request);

      $staff = Staff::where('id',$id_staff)->firstOrFail();
      $staff->fullName = $request->fullName;
      $staff->position = $request->position;
      $staff->disciplines = $request->disciplines;
      $staff->academicDegree = $request->academicDegree;
      $staff->academicTitle = $request->academicTitle;
      $staff->specialty = $request->specialty;
      $staff->training = $request->training;
      $staff->generalExperience = $request->generalExperience;
      $staff->specialtyExperience = $request->specialtyExperience;
      $staff->user_id = $request->user()->id;

      // generation slug
      if (empty($request->slug)) $slug=str_slug($request->fullName);
        else $slug = $request->slug;

      if ($slug!=$staff->slug) {
        if (Staff::where('slug', $slug)->count()>0)
          $staff->slug = $slug.'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s');
        else
         $staff->slug = $slug;
      }

      if ($request->photo!='') {
        $file = $request->file('photo');
        $ext = $file->extension();
        Storage::delete($staff->photo);
        $staff->photo = $file->storeAs('public/staff','avatar-'.str_slug($request->fullName).'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s').'.'.$ext);
      }


      foreach($staff->categories as $category) {
        $category->pivot->delete();
      }

      foreach($request->category as $cat) {
        \Modules\Staff\Entities\StaffCategory::findOrFail($cat)->staffs()->save($staff);
      }

        return redirect()->back()->with([
          'result' => 'Сотрудник успешно изменен',
          'slug' => $slug
        ]);
    }

    public function destroy(Request $request, $id_staff)
    {
      $staff = Staff::where('id',$id_staff)->firstOrFail();
      foreach ($staff->categories as $category) {
        $category->pivot->delete();
      }
      Storage::delete($staff->photo);
      $staff->delete();

      if (str_contains($request->server('HTTP_REFERER'),'dashboard')) {
        //request from dashboard
        return redirect()->back()->with(['result'=>'Сотрудник успешно удален']);
      } else {
        // request from front
        return redirect('/staff/category')->with(['result'=>'Сотрудник успешно удален']);
      }
    }
}
