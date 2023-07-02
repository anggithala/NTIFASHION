<?php

namespace App\Http\Controllers\Owner;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\TransactionDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Request()->ajax()) {
            $query = Transaction::with(['user']);
            return DataTables::of($query)
            ->addColumn('action', function ($item) {
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1
                            type="button" data-toggle="dropdown">Action Button
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="'. route('transaksi.edit', $item->id) .'">
                                    edit
                                </a>
                            </div>
                        </div>
                    </div>
                ';
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
            ->rawColumns(['action'])
            ->make();

        }

        return view('pages.owner.transaksi.index');
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
        //
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
        $transaction = Transaction::with(['transactionDetails.product.productGalleries'])->findOrFail($id);

        return view('pages.owner.transaksi.edit', [
            // 'item' => $item,
            // 'transactions' => $transactions,
            'transaction' => $transaction,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_status = $request->transaction_status;
        $transaction->shipping_status = $request->shipping_status;
        $transaction->save();

        $transactionDetails = TransactionDetail::where('transactions_id', $id)->get();
        if ($transaction->shipping_status == 'SHIPPING') {
            foreach ($transactionDetails as $transactionDetail) {
                $transactionDetail->resi = $request->resi;
                $transactionDetail->save();
            }
        }
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();

        return redirect()->route('transaksi.index');
    }

    /**
     * Cetak transaksi
     *
     */
    public function print(Request $request) {
        // Ambil tanggal dan bulan
        $startDate = Carbon::now()->month($request->startMonth)->year($request->startYear)->startOfMonth();

        $endDate = Carbon::now()->month($request->endMonth)->year($request->endYear)->endOfMonth();

        $request->transaction_status;

        $transactions = Transaction::with(['user'])
                                    ->where('created_at', '>=', $startDate)
                                    ->where('created_at', '<=', $endDate)
                                    ->where('transaction_status', '=', $request->transaction_status)
                                    ->get();

        $pdf = Pdf::loadView('pages.owner.transaksi.cetak', [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'transactions' => $transactions
        ]);
        return $pdf->download('Transaksi_' . time() . '.pdf');
    }
}
