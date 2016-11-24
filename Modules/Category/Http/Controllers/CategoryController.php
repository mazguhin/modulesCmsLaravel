<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Settings;

class CategoryController extends Controller
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


     public function showId($id_category)
     {
       $category = Category::where('id',$id_category)->firstOrFail();
       return view('template::front.'.$this->frontTemplate.'.category.showCategory', [
         'category' => $category,
         'articles' => $category->articles
       ]);
     }

     public function showSlug($slug_category)
     {
       $category = Category::where('slug',$slug_category)->firstOrFail();
       return view('template::front.'.$this->frontTemplate.'.category.showCategory', [
         'category' => $category,
         'articles' => $category->articles
       ]);
     }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

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
