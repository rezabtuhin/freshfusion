<?php

namespace App\Http\Controllers\Page\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();

        $pendingOrders = Order::where('order_by', Auth::user()->id)->where('delivered', 0)->get();
        $receivedOrders = Order::where('order_by', Auth::user()->id)->where('delivered', 1)->get();
//        dd($pendingOrders);
        return view('pages.user.my-order', compact('count', 'pendingOrders', 'receivedOrders'));
    }

    public function receive(Request $request)
    {
        $order = Order::where('order_token', $request->order_token)->first();
        $order->delivered = 1;
        $order->save();
    }
}
