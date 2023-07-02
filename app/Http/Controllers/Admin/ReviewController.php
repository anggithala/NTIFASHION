<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with(['user', 'product.productGalleries', 'replies'])->get();

        // dd($reviews->find(3)->replies->first()->message);

        if (Request()->ajax()) {
            return DataTables::of($reviews)
                ->editColumn('created_at', function ($review) {
                    $timestamp = $review->created_at; // timestamp awal
                    $timezone = 'Asia/Jakarta'; // zona waktu lokal Indonesia
                    setlocale(LC_TIME, 'id_ID'); // set locale ke bahasa Indonesia
                    $local_time = Carbon::createFromTimestamp(strtotime($timestamp))->setTimezone($timezone)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY HH:mm:ss');

                    return $local_time;
                })
                ->addColumn('product_image', function ($review) {
                    return '
                        <div class="card border overflow-hidden" style="width: 6rem;">
                            <div class="border-bottom" style="width: 100%; aspect-ratio: 1 / 1; background-image: url('.asset("storage/".$review->product->productGalleries->first()->photos).'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
                        </div>
                    ';
                })
                ->addColumn('status', function ($review) {
                    if ($review->replies->first()) {
                        return '
                            <span class="badge text-bg-success">Sudah Dibalas</span>
                        ';
                    }

                    return '
                        <span class="badge text-bg-warning">Ulasan Perlu Dibalas</span>
                    ';
                })
                ->addColumn('action', function ($review) {
                    if ($review->replies) {
                        return '
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reviewReplyModal'.$review->id.'">Detail Ulasan</button>
                        ';
                    }

                    return '
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewReplyModal'.$review->id.'">
                            Beri Balasan
                        </button>
                    ';
                })
                ->addIndexColumn()
                ->rawColumns(['product_image', 'status', 'action'])
                ->make();
        }

        return view('pages.admin.review.index', [
            'reviews' => $reviews
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin = User::admin()->first();

        $reviewId = $request->query('id');

        $request->validate([
            'reply' => 'required|string|max:255',
        ]);

        // memastikan bahwa admin belum memberikan balasan ulasan pada produk ini sebelumnya
        if ($admin->replies()->where('review_id', $reviewId)->exists()) {
            return redirect()->back()->with('error', 'Anda sudah memberikan balasan ulasan pada produk ini sebelumnya.');
        }

        $review = Reply::create([
            'review_id' => $reviewId,
            'user_id' => $admin->id,
            'message' => $request->reply
        ]);

        return redirect()->back()->with('success', 'Balasan ulasan produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
