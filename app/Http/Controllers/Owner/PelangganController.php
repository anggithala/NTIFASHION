<?php

namespace App\Http\Controllers\Owner;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\Owner\PelangganRequest;

use Yajra\DataTables\Facades\DataTables;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \illuminate\Http\Response
     */
    public function index()
    {
        if (Request()->ajax()) {
            $query = User::query();

            return DataTables::of($query)
             ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1
                                type="button" data-toggle="dropdown">Action Button
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('pelanggan.edit', $item->id) . '">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.owner.pelanggan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.owner.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \illuminate\Http\Request
     * @return \illuminate\Http\Response
     */
    public function store(PelangganRequest $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('pelanggan.index');
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
        $item = User::findOrFail($id);

        return view('pages.owner.pelanggan.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PelangganRequest $request, string $id)
    {
        $data = $request->all();

        $item = User::findOrFail($id);

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $item->update($data);

        return redirect()->route('pelanggan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('pelanggan.index');
    }
}
