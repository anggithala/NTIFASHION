<?php

namespace App\Http\Controllers\Admin;

use App\Models\Penjualan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\Admin\PenjualanRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
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
                                    <a class="dropdown-item" href="' . route('penjualan.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <Form action="' . route('penjualan.destroy', $item->id) . '" method="POST">
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

        return view('pages.admin.penjualan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.penjualan.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \illuminate\Http\Request
     * @return \illuminate\Http\Response
     */
    public function store(PenjualanRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/penjualan', 'public');

        Penjualan::create($data);

        return redirect()->route('penjualan.index');
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

        return view('pages.admin.penjualan.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PenjualanRequest $request, string $id)
    {
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/penjualan', 'public');

        $item = Penjualan::findOrFail($id);

        $item->update($data);

        return redirect()->route('penjualan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Penjualan::findOrFail($id);
        $item->delete();

        return redirect()->route('penjualan.index');
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

        $penjualans = Penjualan::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->where('status_barang', '=', $request->status_barang)
            ->get();

        $totalHarga = $penjualans->sum('harga');

        $pdf = Pdf::loadView('pages.admin.penjualan.cetak', [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'penjualans' => $penjualans,
            'totalHarga' => $totalHarga
        ]);
        return $pdf->download('Penjualan_' . time() . '.pdf');
    }
}
