<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use RoleHelper;
use Settings;
use Modules\Article\Entities\Article;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BackArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

     use ValidatesRequests;

     protected $frontTemplate = '';

     public function __construct()
     {
       $this->frontTemplate = Settings::getFrontTemplate();
     }

    public function index()
    {
        echo Auth::user()->role->name;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      return view('template::back.'.$this->frontTemplate.'.article.create',[
        'categories' => \Modules\Category\Entities\Category::all()
      ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      //validation
      $this->validate($request, [
        'title' => 'required|max:255',
        'description' => 'max:255',
        'editor' => 'required',
        'permission' => 'required|max:255',
        'category' => 'required|max:255',
      ],[
        'title.required' => 'Заполните заголовок',
        'editor.required' => 'Заполните основной текст',
        'category.required' => 'Выберите категорию',
        'permission.required' => 'Назначьте доступ',
        'max' => 'Макс. кол-во символов: 255 (Заголовок, Описание)'
      ]);

      $article = new Article;
      $article->title = $request->title;
      $article->description = $request->description;
      $article->body = $request->editor;
      $article->permission = $request->permission;
      // $article->user_id = Auth::user()->id;
      $article->category_id = $request->category;

      // generation slug
      $slug = str_slug($request->title);
      if (Article::where('slug', $slug)->count())
        $article->slug = $slug.'-'.\Carbon\Carbon::now()->format('d-m-Y-h-m-s');
      else
        $article->slug = $slug;

      if ($request->user()->articles()->save($article))
        return redirect()->back()->with([
          'result' => 'Статья успешно добавлена',
          'slug' => $slug
        ]);
      else
        return redirect()->back()->with('result', 'Возникла ошибка');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        echo 'OK';
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
