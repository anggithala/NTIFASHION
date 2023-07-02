<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROProvince;
use Dipantry\Rajaongkir\Constants\RajaongkirCourier;

class ShippingCostsController extends Controller
{
    public function getShippingCosts(Request $request, String $origin_id, String $destination_id, String $weight, String $courier)
    {
        // $originCity = ROCity::find($src_id);
        // $destinationCity = ROCity::find($dst_id);

        $shippingCosts = \Rajaongkir::getOngkirCost(
            $origin = intval($origin_id), $destination = intval($destination_id), $weight = intval($weight), $courier = $courier
        );

        // dd($shippingCosts);
        // return json_encode($shippingCosts);
        return json_encode($shippingCosts[0]['costs']);
        // dd($shippingCosts);
    }
}
