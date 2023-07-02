<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\Admin\UserRequest;

use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
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

            ->make();
        }

        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \illuminate\Http\Request
     * @return \illuminate\Http\Response
     */
    //public function store(UserRequest $request)
    //{
    //    $data = $request->all();

    //    $data['password'] = bcrypt($request->password);

    //    User::create($data);

    //    return redirect()->route('user.index');
    //}

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
        //$item = User::findOrFail($id);

        //return view('pages.admin.user.edit', [
        //    'item' => $item
        //]);
    }

    /**
     * Update the specified resource in storage.
     */
    //public function update(UserRequest $request, string $id)
    //{
        //$data = $request->all();

        //$item = User::findOrFail($id);

        //if ($request->password) {
        //    $data['password'] = bcrypt($request->password);
        //} else {
        //    unset($data['password']);
        //}

        //$item->update($data);

        //return redirect()->route('user.index');
    //}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('user.index');
    }
}
