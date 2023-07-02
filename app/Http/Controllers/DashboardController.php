<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Models\TransactionDetail;
use App\Models\Transaction;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // dd($user->transaction);
        return view('pages.dashboard', [
            'transactions' => $user->transaction
        ]);
        // $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
        //                     ->whereHas('product', function($product){
        //                         $product->where('id', Auth::user()->id);
        //                     });

        // $revenue = $transactions->get()->reduce(function ($carry, $item) {
        //     return $carry + $item->price;
        // });

        // $customer = User::count();

        // return view('pages.dashboard',[
        //     'transaction_count' => $transactions->count(),
        //     'transaction_data' => $transactions->get(),
        //     'revenue' => $revenue,
        //     'customer' => $customer,
        // ]);
    }
}
