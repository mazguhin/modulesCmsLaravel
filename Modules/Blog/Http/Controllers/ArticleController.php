<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Entities\Article;
use Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ArticleController extends Controller
{
  use ValidatesRequests;

  public function validateForm(Request $request)
  {
    return($this->validate($request, [
      'title' => 'required|max:255',
      'body' => 'required',
      'category' => 'required|max:255',
    ],[
      'title.required' => 'Заполните заголовок',
      'body.required' => 'Заполните основной текст',
      'category.required' => 'Выберите категорию',
      'max' => 'Макс. кол-во символов: 255 (Заголовок)'
    ]));
  }

  public function store(Request $request, Blog $blog)
  {
    $this->validateForm($request);

    $article = new Article;
    $article->title = request()->title;
    $article->body = request()->body;
    $article->category_id = request()->category;
    Auth::user()->blogArticles()->save($article);

    return back()->with(['result' => 'Статья успешно добавлена']);
  }

  public function show(Blog $blog, Article $article)
  {
    return view('blog::'.$blog->template.'.article', [
      'blog' => $blog,
      'categories' => $blog->categories,
      'article' => $article,
    ]);
  }

  public function save(Blog $blog, Article $article)
  {
    $this->validateForm(request());

    $article->title = request()->title;
    $article->body = request()->body;
    $article->category_id = request()->category;
    $article->save();

    return back()->with(['result' => 'Статья успешно изменена']);
  }

  public function delete(Blog $blog, Article $article)
  {
    $category = $article->category->id;
    $article->delete();

    return redirect("/blog/id/{$blog->id}/category/{$category}")->with(['result' => 'Статья успешно удалена']);
  }
}
