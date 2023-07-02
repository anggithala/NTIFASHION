<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use Illuminate\Support\Str;

use Exception;

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use PhpParser\Node\Stmt\Return_;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        //save users data
        $user = Auth::user();

        //process checkout
        $code = 'STORE-' . mt_rand(000000, 999999);
        $carts = Cart::with(['product', 'user'])
            ->where('users_id', $user->id)
            ->get();
        // dd($carts[1]->selected_size);



        //Transaction create
        $transaction = Transaction::create([
            'users_id' => $user->id,
            'insurance_price' => $request->insurance_price,
            'shipping_price' => $request->shipping_price,
            'total_price' => $request->total_price,
            'shipping_status' => 'PENDING',
            'transaction_status' => 'PENDING',
            'code' => $code,
            'courier' => $request->courier,
            'service' => $request->service_hidden
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(000000, 999999);

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'size' => $cart->selected_size,
                'price' => $cart->product->price,
                'resi' => '',
                'code' => $trx,
            ]);
        }

        //delete cart data
        Cart::with(['product','user'])
                ->where('users_id', $user->id)
                ->delete();

        //konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        //Buat Array untuk dikirim ke midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => $request->total_price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'enabled_payments' =>[
                "bca_va", "bni_va", "bri_va", "gopay", "shopeepay", "permata_va", "bank_transfer"
            ],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();

            // Redirect to Snap Payment Page
            return redirect()->route('dashboard-transactions')->with('success', 'Berhasil untuk melanjutkan checkout.');
        } catch (Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        // set konfigurasi midtrans
        config::$serverKey = config('services.midtrans.serverKey');
        config::$isProduction = config('services.midtrans.isProduction');
        config::$isSanitized = config('services.midtrans.isSanitized');
        config::$is3ds = config('services.midtrans.is3ds');

        // Instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);

        // Handle notification status
        if($status == 'capture') {
            if($type == 'credit_card') {
                if($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                }
                else {
                    $transaction->status = 'SUCCESS';
                }
            }
        }
        elseif($status == 'settlement') {
            $transaction->status = 'SUCCESS';
        }
        elseif($status == 'pending') {
            $transaction->status = 'PENDING';
        }
        elseif($status == 'deny') {
            $transaction->status = 'CANCELLED';
        }
        elseif($status == 'expire') {
            $transaction->status = 'CANCELLED';
        }
        elseif($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }

        // Simpan transaksi
        $transaction->save();



    }
}
