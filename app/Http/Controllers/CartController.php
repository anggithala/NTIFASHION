<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ShippingCost;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROProvince;
use Dipantry\Rajaongkir\Constants\RajaongkirCourier;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admin = User::all()->first();

        $adminProvince = ROProvince::find($admin->provinces_id);
        $adminCity = ROCity::find($admin->regencies_id);

        $carts = Cart::with(['product.productGalleries', 'user'])->where('users_id', Auth::user()->id)->get();

        $user = Auth::user();

        $currentProvince = ($user->provinces_id) ? ROProvince::find($user->provinces_id) : NULL;

        if (!$currentProvince) {
            return redirect()->route('dashboard-setting-account')->with('error', 'Gagal melihat cart. Silakan lengkapi informasi akun terlebih dahulu.');
        }

        $currentCity = ($user->regencies_id) ? ROCity::find($user->regencies_id) : NULL;

        $couriers = [RajaongkirCourier::JNE, RajaongkirCourier::POS_INDONESIA, RajaongkirCourier::TIKI];

        return view('pages.cart', [
            'admin' => $admin,
            'adminProvince' => $adminProvince,
            'adminCity' => $adminCity,
            'carts' => $carts,
            'user' => $user,
            'currentProvince' => $currentProvince,
            'currentCity' => $currentCity,
            'couriers' => $couriers
        ]);
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages.success');
    }
}
