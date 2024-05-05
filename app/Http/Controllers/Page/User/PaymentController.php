<?php

namespace App\Http\Controllers\Page\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $token = Str::random(8);
        $userCarts = Cart::where('order_by', $userId)
            ->where('checkout', 0)->get();
        $amount = 0;
        foreach ($userCarts as $userCart){
            $curFood = Food::find($userCart->food_id);
            $amount += intval($curFood->price_per_quantity) - intval($curFood->discount);
        }
        $distinctVendor = Cart::where('order_by', $userId)
            ->where('checkout', 0)
            ->distinct()
            ->pluck('vendor');
        $vendor = null;
        foreach ($distinctVendor as $ven){
            $vendor = $ven;
        }
        $order = Order::create([
            'order_token' => $token,
            'order_by' => Auth::user()->id,
            'vendor' => $vendor,
            'location' => $request->location,
            'amount' => $amount
        ]);

        Cart::where('order_by', $userId)
            ->where('checkout', 0)
            ->where('vendor', $vendor)
            ->update([
                'checkout' => 1,
                'order_token' => $order->id
            ]);
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();
        return redirect('/phone');
    }
}
