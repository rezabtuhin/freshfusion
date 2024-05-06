<?php

namespace App\Http\Controllers\Page\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function otp(Request $request)
    {
        Session::put('don:phone'.Auth::user()->id, $request->phone);
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();
        return view('pages.user.donation-otp', compact('count'));
    }

    public function amount(Request $request)
    {
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();
        Session::put('don:amount'.Auth::user()->id, $request->amount);
        return view('pages.user.donation-pin', compact('count'));
    }

    public function paid(Request $request)
    {
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();

        $amount = Session::get('don:amount'.Auth::user()->id);
        $phone = Session::get('don:phone'.Auth::user()->id);
        $transactionID = Str::random(10);

        Donation::create([
            'user_id' => Auth::user()->id,
            'amount' => $amount,
            'number' => $phone,
            'transaction_id' => $transactionID
        ]);

        Session::forget(['don:amount'.Auth::user()->id, 'don:phone'.Auth::user()->id]);
        return response()->json(["message" => "success"]);
    }
}
