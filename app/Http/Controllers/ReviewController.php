<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, String $productId)
    {
        $user = Auth::user();

        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        // memastikan bahwa user belum memberikan review pada produk ini sebelumnya
        if ($user->reviews()->where('product_id', $productId)->exists()) {
            return redirect()->back()->with('error', 'Anda sudah memberikan review pada produk ini sebelumnya.');
        }

        $review = Review::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan.');
    }
}