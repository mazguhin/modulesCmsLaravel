<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Settings;
use RoleHelper;

class ArticleController extends Controller
{
     protected $frontTemplate = '';

     public function __construct()
     {
       $this->frontTemplate = Settings::getFrontTemplate();
     }

    public function showId($id_article)
    {
      $article = Article::where('id',$id_article)->firstOrFail();

      if (!RoleHelper::validatePermissionForPage($article->role->permission) || !RoleHelper::validatePermissionForPage($article->category->role->permission))
        return view('template::front.'.$this->frontTemplate.'.article.accsesDenied');

      return view('template::front.'.$this->frontTemplate.'.article.showArticle', [
        'article' => $article
      ]);
    }

    public function showSlug($slug_article)
    {
      $article = Article::where('slug',$slug_article)->firstOrFail();

      if (!RoleHelper::validatePermissionForPage($article->role->permission) || !RoleHelper::validatePermissionForPage($article->category->role->permission))
        return view('template::front.'.$this->frontTemplate.'.article.accsesDenied');

      return view('template::front.'.$this->frontTemplate.'.article.showArticle', [
        'article' => $article
      ]);
    }
}
