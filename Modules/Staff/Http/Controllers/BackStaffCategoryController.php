<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Settings;
use Logs;
use Modules\Staff\Entities\StaffCategory;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BackStaffCategoryController extends Controller
{
     use ValidatesRequests;

     protected $backTemplate = '';

     public function __construct()
     {
       $this->backTemplate = Settings::getBackTemplate();
     }

    public function validateForm(Request $request)
    {
      return($this->validate($request, [
        'name' => 'required|max:255',
        'description' => 'max:255',
        'slug' => 'max:255'
      ],[
        'name.required' => 'Заполните название',
        'max' => 'Макс. кол-во символов: 255 (Название, Описание, URL)'
      ]));
    }

    public function show()
    {
      return view('template::back.'.$this->backTemplate.'.staff.category.show',[
        'staffCategories' => StaffCategory::orderBy('created_at', 'desc')->paginate(100)
      ]);
    }

    public function create()
    {
      return view('template::back.'.$this->backTemplate.'.staff.category.create',[

      ]);
    }

    public function store(Request $request)
    {
      // validation
      $this->validateForm($request);

      $category = new StaffCategory;
      $category->name = $request->name;
      $category->description = $request->description;

      // generation slug
      if (empty($request->slug)) $slug=str_slug($request->name);
        else $slug = $request->slug;

      if (StaffCategory::where('slug', $slug)->count()>0)
        $category->slug = $slug.'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s');
      else
        $category->slug = $slug;

      if ($request->user()->staffCategories()->save($category)) {
        Logs::set('Добавлена категория ['.$category->name.']');
        return redirect()->back()->with([
          'result' => 'Категория успешно добавлена',
          'slug' => $slug
        ]);
      }
      else
        return redirect()->back()->with('result', 'Возникла ошибка');
    }

    public function editById($id_category)
    {
      return view('template::back.'.$this->backTemplate.'.staff.category.edit',[
        'category' => StaffCategory::where('id',$id_category)->firstOrFail()
      ]);
    }

     public function update(Request $request, $id_category)
     {
       // validation
       $this->validateForm($request);

       $category = StaffCategory::where('id',$id_category)->firstOrFail();
       $category->name = $request->name;
       $category->description = $request->description;

       // generation slug
       if (empty($request->slug)) $slug=str_slug($request->name);
         else $slug = $request->slug;

       if ($slug!=$category->slug) {
         if (Category::where('slug', $slug)->count()>0)
           $category->slug = $slug.'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s');
         else
          $category->slug = $slug;
       }

       if ($category->save()) {
         Logs::set('Изменена категория ['.$category->name.']');
         return redirect()->back()->with([
           'result' => 'Категория успешно обновлена',
           'slug' => $category->slug
         ]);
       }
       else
         return redirect()->back()->with('result', 'Возникла ошибка');
     }

    public function destroy(Request $request, $id_category)
    {
      $category = StaffCategory::where('id',$id_category)->firstOrFail();
      $staffs = $category->staffs;

      foreach ($category->staffs as $staff) {
        foreach ($staff->categories as $cat)
        {
          $cat->pivot->delete();
        }
      }

      foreach ($staffs as $staff) {
        $staff->delete();
      }
      $category->delete();
      Logs::set('Удалена категория ['.$category->name.']');

      if (str_contains($request->server('HTTP_REFERER'),'dashboard')) {
        // request from dashboard
        return redirect()->back()->with(['result'=>'Категория успешно удалена']);
      } else {
        // request from front
        return redirect('staff/category')->with(['result'=>'Категория успешно удалена']);
      }
    }
}
