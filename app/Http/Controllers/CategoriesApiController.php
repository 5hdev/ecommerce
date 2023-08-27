<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoriesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('products')->get();

        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function latest_product_in_categories()
    {
        $categories = Category::all();

        foreach ($categories as $cat) {
            $cat->latest_products = $cat->products()->latest('id')->limit(1)->get();
        }

        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function category_content(Request $request)
    {
        //
        $child_cats = Category::with('products')->where('parent_id',$request->parent_cat)->get();

        return response()->json([
            'child_cats' => $child_cats
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
