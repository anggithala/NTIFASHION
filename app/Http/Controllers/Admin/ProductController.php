<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\User;

use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \illuminate\Http\Response
     */
    public function index()
    {
        if (Request()->ajax()) {
            $query = Product::with(['category'])->get();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1
                                type="button" data-toggle="dropdown">Action Button
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="'. route('product.edit', $item->id) .'">
                                        Edit
                                    </a>
                                    <Form action="'.route('product.destroy', $item->id).'" method="POST">
                                    ' . method_field('delete') . csrf_field() .'
                                        <button type="submit" class="dropdown-item text-danger">
                                            Delete
                                        </button>
                                    </Form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('price', function ($item) {
                    return 'Rp ' . number_format($item->price);
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('pages.admin.product.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param \illuminate\Http\Request
     * @return \illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request['size'] = implode(" , ", $request->size);

        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        Product::create($data);

        return redirect()->route('product.index');
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
        $item = Product::findOrFail($id);
        $categories = Category::all();

        $sizes = preg_split('/[\s,]+/', $item->size);

        return view('pages.admin.product.edit', [
            'item' => $item,
            'categories' => $categories,
            'sizes' => $sizes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->all();

        $item = Product::findOrFail($id);

        $data['size'] = implode(" , ", $request->size);
        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        return redirect()->route('product.index');
    }
}
