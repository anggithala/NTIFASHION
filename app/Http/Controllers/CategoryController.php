<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index(Request $request, String $slug)
    {
        $category = Category::where('slug', $slug)->get();
        $products = Product::where('categories_id', $category[0]->id)->with(['productGalleries'])->paginate(16);

        return view('pages.categories', [
            'category' => $category[0],
            'products' => $products
        ]);
    }
}
