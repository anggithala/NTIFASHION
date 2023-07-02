<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class SeragamController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::where('categories_id', 3)->with(['galleries'])->paginate(16);


        return view('pages.seragam', [
            'categories' =>  $categories,
            'products' => $products
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        return view('pages.seragam', [
            'category' => $category

        ]);
    }
}
