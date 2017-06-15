<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Article;

class BlogController extends Controller
{
  public function show(Blog $blog)
  {
    return view('blog::'.$blog->template.'.index', [
      'blog' => $blog,
      'categories' => $blog->categories,
      'articles' => $blog->articles()->orderBy('created_at', 'desc')->paginate(5),
    ]);
  }

  public function showId(Blog $blog)
  {
    return $this->show($blog);
  }

  public function showSlug($slug_blog)
  {
    return $this->show(Blog::where('slug',$slug_blog)->first());
  }

  public function editAbout(Blog $blog)
  {
    $blog->about = request()->about;
    $blog->save();
    return back()->with(['result'=>'Информация успешно обновлена']);
  }

  public function editTitle(Blog $blog)
  {
    $blog->title = request()->title;
    $blog->description = request()->description;
    $blog->save();
    return back()->with(['result'=>'Информация успешно обновлена']);
  }
}
