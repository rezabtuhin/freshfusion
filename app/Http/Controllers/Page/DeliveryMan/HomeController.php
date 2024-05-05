<?php

namespace App\Http\Controllers\Page\DeliveryMan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $onGoingOrders = Order::where('order_taken_by', null)
                        ->get();
        return view('pages.delivery.home', compact('onGoingOrders'));
    }

    public function acceptOrder($order_token)
    {
        $order = Order::where('order_token', $order_token)->first();
        if ($order){
            $order->order_taken_by = Auth::user()->id;
            $order->save();
        }
        return redirect('/me/dashboard');
    }

    public function deliveries()
    {
        $pendingDeliveries = Order::where('order_taken_by', Auth::user()->id)
                            ->where('delivered', 0)
                            ->get();
        $doneDeliveries = Order::where('order_taken_by', Auth::user()->id)
                            ->where('delivered', 1)
                            ->get();
        return view('pages.delivery.my-deliveries', compact('pendingDeliveries', 'doneDeliveries'));

    }

    public function cancel($order_token)
    {
        $order = Order::where('order_token', $order_token)->first();
        $order->order_taken_by = null;
        $order->save();
        return redirect('/me/deliveries');
    }

    public function update_order(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->current_status = $request->current_status;
        $order->save();
        return "Success";
    }
}
