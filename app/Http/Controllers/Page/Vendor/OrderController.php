<?php

namespace App\Http\Controllers\Page\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;

        $pendingOrders = Order::where('vendor', $user)
            ->where(function ($query) {
                $query->whereNotIn('current_status', ['Picked', 'Delivered'])
                    ->orWhereNull('current_status');
            })
            ->get();
        $receivedOrders = DB::table('orders')
                            ->where('vendor', $user)
                            ->where('current_status', 'Picked')
                            ->orWhere('current_status', 'Delivered')
                            ->get();
//        dd($receivedOrders);
        return view('pages.vendor.order', compact('pendingOrders', 'receivedOrders'));
    }

    public function update(Request $request)
    {
        $order = Order::findOrFail($request->id);

        // Update the current status of the order
        $order->current_status = $request->current_status;
        $order->save();
        return response()->json(['message' => 'Order status updated successfully'], 200);
    }
}
