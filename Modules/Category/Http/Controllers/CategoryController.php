<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    

     public function showId($id_category)
     {
       $category = Category::where('id',$id_category)->firstOrFail();
       return view('category::show', [
         'category' => $category,
         'articles' => $category->articles
       ]);
     }

     public function showSlug($slug_category)
     {
       $category = Category::where('slug',$slug_category)->firstOrFail();
       return view('category::show', [
         'category' => $category,
         'articles' => $category->articles
       ]);
     }

    public function index()
    {
        return view('category::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('category::create');
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
        return view('category::edit');
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
