<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;
use Yajra\DataTables\Facades\DataTables;

class DashboardTransactionsController extends Controller
{

    public function index()
    {
        if (Request()->ajax()) {
            $user = User::with(['transactions'])->findOrFail(Auth::user()->id);


            return DataTables::of($user->transactions)
                ->editColumn('insurance_price', function ($item) {
                    return 'Rp ' . number_format($item->insurance_price);
                })
                ->editColumn('shipping_price', function ($item) {
                    return 'Rp ' . number_format($item->shipping_price);
                })
                ->editColumn('total_price', function ($item) {
                    return 'Rp ' . number_format($item->total_price);
                })
                ->editColumn('created_at', function ($item) {
                    $timestamp = $item->created_at; // timestamp awal
                    $timezone = 'Asia/Jakarta'; // zona waktu lokal Indonesia
                    setlocale(LC_TIME, 'id_ID'); // set locale ke bahasa Indonesia
                    $local_time = Carbon::createFromTimestamp(strtotime($timestamp))->setTimezone($timezone)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY HH:mm:ss');

                    return $local_time;
                })
                ->addColumn('transaction_status', function ($item) {
                    return '
                    <div class="btn btn-info text-white">' . ucwords(strtolower($item->transaction_status)) . '</div>
                ';
                })
                ->addColumn('shipping_status', function ($item) {
                    return '
                    <div class="btn btn-info text-white">' . ucwords(strtolower($item->shipping_status)) . '</div>
                ';
                })
                ->addColumn('action', function ($item) {
                    if ($item->transaction_status == 'SUCCESS' && $item->shipping_status == 'SUCCESS') {
                        return '
                            <a href="'.route('dashboard-transactions-details', $item->id).'" class="btn btn-primary mb-2">Details Order</a>
                            <a href="'.route('product-transaction-details', $item->id).'" class="btn btn-secondary mb-2">Details Product</a>
                        ';
                    }

                    if ($item->transaction_status == 'SUCCESS') {
                        return '
                            <a href="' . route('dashboard-transactions-details', $item->id) . '" class="btn btn-primary mb-2">Detail Order</a>
                            <button type="button" class="btn btn-success">Payment Success</button>
                        ';
                    }

                    return '
                        <a href="' . route('dashboard-transactions-details', $item->id) . '" class="btn btn-primary mb-2">Details Order</a>
                        <a href="' . $item->payment_url . '" class="btn btn-success" target="_blank">Payment</a>
                    ';
                })
                ->addIndexColumn()
                ->rawColumns(['transaction_status', 'shipping_status', 'action'])
                ->make();
        }

        return view('pages.dashboard-transactions');
    }

    public function details(Request $request, string $id)
    {
        $transaction = Transaction::with(['transactionDetails.product.productGalleries'])
            ->where('users_id', Auth::user()->id)
            ->findOrFail($id);

        return view('pages.dashboard-transactions-details', [
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transactions-details', $id);
    }

    public function received(Request $request, $id) {
        $transaction = Transaction::find($id);

        $transaction->update([
            'shipping_status' => 'SUCCESS'
        ]);
        return back();
    }
}
