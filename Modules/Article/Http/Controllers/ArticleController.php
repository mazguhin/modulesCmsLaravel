<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Settings;
use RoleHelper;
use Cache;

class ArticleController extends Controller
{
     protected $frontTemplate = '';

     public function __construct()
     {
       $this->frontTemplate = Settings::getFrontTemplate();
     }

     public function show($article)
     {
       if (!RoleHelper::validatePermissionForPage($article->role->permission) || !RoleHelper::validatePermissionForPage($article->category->role->permission))
         return view('template::front.'.$this->frontTemplate.'.article.accsesDenied');

       return view('template::front.'.$this->frontTemplate.'.article.showArticle', [
         'article' => $article
       ]);
     }

      public function showId($id_article)
      {
        return $this->show(Cache::get('article.'.$id_article, function() use ($id_article) {
          $tmpArticle = Article::where('id',$id_article)->firstOrFail();
          Cache::add('article.'.$id_article, $tmpArticle, 30); // cache 30 min
          return $tmpArticle;
        }));
      }

      public function showSlug($slug_article)
      {
        return $this->show(Article::where('slug',$slug_article)->firstOrFail());
      }
}
