<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use RoleHelper;
use Settings;
use Logs;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Entities\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BackBlogController extends Controller
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
      'slug' => 'required|max:255',
      'moder' => 'required|max:255',
      'description' => 'max:255',
    ],[
      'name.required' => 'Заполните название',
      'slug.required' => 'Заполните адрес',
      'moder.required' => 'Назначьте модератора',
      'max' => 'Макс. кол-во символов: 255 (Название, Описание, Адрес)'
    ]));
  }

  public function getModers()
  {
    $moders = collect([]);
    foreach (\App\User::with('role')->get() as $user){
        if (RoleHelper::checkAdminOrModer($user))
          $moders->push($user);
    }
    return $moders;
  }

  public function show()
  {
    return view('template::back.'.$this->backTemplate.'.blog.show',[
      'blogs' => Blog::orderBy('created_at', 'desc')->paginate(100)
    ]);
  }

  public function create()
  {
    return view('template::back.'.$this->backTemplate.'.blog.create',[
      'moders' => $this->getModers()
    ]);
  }

  public function store(Request $request)
  {
    // validation
    $this->validateForm($request);

    $slug = str_slug($request->slug);

    if (Blog::where('slug', $slug)->count()>0)
      return back()->with(['result' => 'Выбранный адрес ['.$slug.'] занят']);

    $blog = new Blog;
    $blog->title = $request->name;
    $blog->description = $request->description;
    $blog->slug = $slug;
    $blog->moder_id = $request->moder;
    $blog->about = '';
    $blog->template = 'standard';
    $blog->save();

    if ($blog->save()) {
      Logs::set('Добавлен блог ['.$blog->title.']');
      return redirect()->back()->with([
        'result' => 'Блог успешно добавлен',
        'blog_id' => $blog->id
      ]);
    }
    else
      return redirect()->back()->with('result', 'Возникла ошибка');
  }

  public function editById(Blog $blog)
  {
    return view('template::back.'.$this->backTemplate.'.blog.edit',[
      'blog' => $blog,
      'users' => $this->getModers()
    ]);
  }

  public function update(Request $request, Blog $blog)
  {
    // validation
    $this->validateForm($request);

    $slug = str_slug($request->slug);

    if ($blog->slug != $slug && Blog::where('slug', $slug)->count()>0)
      return back()->with(['result' => 'Выбранный адрес ['.$slug.'] занят']);

    $blog->title = $request->name;
    $blog->description = $request->description;
    $blog->slug = $slug;
    $blog->moder_id = $request->moder;
    $blog->save();

    if ($blog->save()) {
      Logs::set('Изменен блог ['.$blog->title.']');
      return redirect()->back()->with([
        'result' => 'Блог успешно обновлен',
        'blog_id' => $blog->id
      ]);
    }
    else
      return redirect()->back()->with('result', 'Возникла ошибка');
  }

  public function destroy(Request $request, Blog $blog)
  {
    foreach ($blog->categories as $category) {
      foreach ($category->articles as $article)
        $article->delete();

      $category->delete();
    }

    Logs::set('Удален блог ['.$blog->title.']');
    $blog->delete();

    if (str_contains($request->server('HTTP_REFERER'),'dashboard')) {
      // request from dashboard
      return redirect()->back()->with(['result'=>'Блог успешно удален']);
    } else {
      // request from front
      return redirect('/')->with(['result'=>'Блог успешно удален']);
    }
  }
}
