<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Article;

class CategoryController extends Controller
{
  public function store(Blog $blog)
  {
    $category = new Category;
    $category->title = request()->title;
    $blog->categories()->save($category);
    return back()->with(['result' => 'Категория успешно добавлена']);
  }

  public function show(Blog $blog, Category $category)
  {
    return view('blog::'.$blog->template.'.index', [
      'blog' => $blog,
      'categories' => $blog->categories,
      'articles' => $category->articles()->orderBy('created_at', 'desc')->paginate(5),
    ]);
  }
}
