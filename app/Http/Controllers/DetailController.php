<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use Termwind\Components\Dd;
use App\Models\Cart;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, String $slug)
    {
        $admin = User::all()->first();

        $productId = $request->query('id');

        $product = Product::with(['productGalleries'])->where('id', $productId)->firstOrFail();
        $sizeS = str_contains($product->size, 'S');
        $sizeM = str_contains($product->size, 'M');
        $sizeL = str_contains($product->size, 'L');
        $sizeXL = str_contains($product->size, 'XL');

        $reviews = Review::with(['user', 'replies'])->where('product_id', $productId)->get();

        return view('pages.detail', [
            'admin' => $admin,
            'product' => $product,
            'sizeS' =>  $sizeS,
            'sizeM' => $sizeM,
            'sizeL' => $sizeL,
            'sizeXL' => $sizeXL,
            'reviews' => $reviews
        ]);
    }

    public function add(Request $request, $id)
    {
        $request->validate([
            'size' => 'required',
        ]);

        $selectedSize = $request->size;


        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id,
            'selected_size' => $selectedSize,
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }
}
