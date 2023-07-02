<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email not found']);
        }
        
        $token = Str::random(60);
        
        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        
        Mail::to($user->email)->send(new ResetPasswordMail($token));
        
        return back()->with('status', 'Password reset link sent successfully');
    }
    
}
