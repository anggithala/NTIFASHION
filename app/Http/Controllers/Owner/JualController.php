<?php

namespace App\Http\Controllers\Owner;

use App\Models\Penjualan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\Owner\JualRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class JualController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \illuminate\Http\Response
     */
    public function index()
    {
        if (Request()->ajax()) {
            $query = Penjualan::latest()->get();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1
                                type="button" data-toggle="dropdown">Action Button
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('jual.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <Form action="' . route('jual.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Delete
                                        </button>
                                    </Form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('photo', function ($item) {
                    return $item->photo ? '<img src="' . Storage::url($item->photo) . '" style="width: 40px;"\>' : '';
                })
                ->rawColumns(['action', 'photo'])
                ->make();
        }

        return view('pages.owner.jual.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.owner.jual.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \illuminate\Http\Request
     * @return \illuminate\Http\Response
     */
    public function store(JualRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/penjualan', 'public');

        Penjualan::create($data);

        return redirect()->route('jual.index');
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
        $item = Penjualan::findOrFail($id);

        return view('pages.owner.jual.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JualRequest $request, string $id)
    {
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/penjualan', 'public');

        $item = Penjualan::findOrFail($id);

        $item->update($data);

        return redirect()->route('jual.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Penjualan::findOrFail($id);
        $item->delete();

        return redirect()->route('jual.index');
    }

    /**
     * Cetak penjualan
     *
     */
    public function print(Request $request)
    {
        // Ambil tanggal dan bulan
        $startDate = Carbon::now()->month($request->startMonth)->year($request->startYear)->startOfMonth();

        $endDate = Carbon::now()->month($request->endMonth)->year($request->endYear)->endOfMonth();

        $request->transaction_status;

        $penjualans = Penjualan::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->where('transaction_status', '=', $request->transaction_status)
            ->get();

        $totalHarga = $penjualans->sum('total_price');

        $pdf = Pdf::loadView('pages.owner.jual.cetak', [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'penjualans' => $penjualans,
            'totalHarga' => $totalHarga
        ]);
        return $pdf->download('Penjualan_' . time() . '.pdf');
        //return $pdf->stream();
    }
}
