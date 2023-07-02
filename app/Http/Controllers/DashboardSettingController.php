<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROProvince;

class DashboardSettingController extends Controller
{
    public function account()
    {
        $user = Auth::user();

        $provinces = ROProvince::all();
        $currentProvince = ($user->provinces_id) ? ROProvince::find($user->provinces_id) : NULL;
        $currentCity = ($user->regencies_id) ? ROCity::find($user->regencies_id) : NULL;

        return view('pages.dashboard-account', [
            'user' => $user,
            'provinces' => $provinces,
            'currentProvince' => $currentProvince,
            'currentCity' => $currentCity
        ]);
    }

    public function getCities(Request $request, String $id)
    {
        $cities = ROCity::all()->where('province_id', $id)->map->only('id', 'name', 'postal_code');

        return json_encode($cities);
    }

    public function getPostalCode(Request $request, String $id)
    {
        $postalCode = ROCity::where('id', $id)->get('postal_code');

        return json_encode($postalCode);
    }
}
