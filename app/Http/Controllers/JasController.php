<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class JasController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::where('categories_id', 5)->with(['galleries'])->paginate(16);


        return view('pages.jas', [
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

        return view('pages.jas', [
            'category' => $category

        ]);
    }
}
