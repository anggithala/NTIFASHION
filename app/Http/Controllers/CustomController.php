<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;


class CustomController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(String $id)
    {
        $categories = Category::get('slug');
        $products = Product::where('categories_id', $id)->with(['galleries'])->paginate(16);

        return view('pages.custom', [
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

        return view('pages.custom', [
            'category' => $category
        ]);
    }
}
