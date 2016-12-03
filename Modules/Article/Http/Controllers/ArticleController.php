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
    /**
     * Display a listing of the resource.
     * @return Response
     */

     protected $frontTemplate = '';

     public function __construct()
     {
       $this->frontTemplate = Settings::getFrontTemplate();
     }

    public function index()
    {
        return view('article::index');
    }

    public function showId($id_article)
    {

      return view('template::front.'.$this->frontTemplate.'.article.showArticle', [
        'article' => Article::where('id',$id_article)->firstOrFail()
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

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('article::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('article::edit');
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
