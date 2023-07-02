<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductTransactionsController extends Controller
{
    public function index(String $transactionId)
    {
        $transaction = Transaction::with(['transactionDetails.product.productGalleries'])
            ->findOrFail($transactionId);

        return view('pages.product-transaction-details', [
            'transaction' => $transaction
        ]);
    }
}
