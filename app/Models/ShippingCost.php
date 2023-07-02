<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCost extends Model
{
    use HasFactory;

    public static function calculateCost($startCity, $endCity, $distance) {
        $costPerKm = 1000; // biaya per kilometer
        $shippingCost = $costPerKm * $distance;
        return $shippingCost;
    }
    
}
