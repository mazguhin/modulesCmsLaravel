<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Article;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CategoryController extends Controller
{
  use ValidatesRequests;

  public function validateForm(Request $request)
  {
    return($this->validate($request, [
      'title' => 'required|max:255',
    ],[
      'title.required' => 'Заполните заголовок',
      'max' => 'Макс. кол-во символов: 255 (Заголовок)'
    ]));
  }

  public function store(Blog $blog)
  {
    $this->validateForm(request());

    $category = new Category;
    $category->title = request()->title;
    $blog->categories()->save($category);
    return back()->with(['result' => 'Категория успешно добавлена']);
  }

  public function show(Blog $blog, Category $category)
  {
    return view('blog::'.$blog->template.'.category', [
      'blog' => $blog,
      'categories' => $blog->categories,
      'category' => $category,
      'articles' => $category->articles()->orderBy('created_at', 'desc')->paginate(5),
    ]);
  }

  public function save(Blog $blog, Category $category)
  {
    $this->validateForm(request());

    $category->title = request()->title;
    $category->save();
    return back()->with(['result' => 'Категория успешно изменена']);
  }

  public function delete(Blog $blog, Category $category)
  {
    foreach ($category->articles as $article)
      $article->delete();

    $category->delete();

    return redirect("/blog/{$blog->slug}/")->with(['result' => 'Категория успешно удалена']);
  }
}
