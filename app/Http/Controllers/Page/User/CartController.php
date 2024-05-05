<?php

namespace App\Http\Controllers\Page\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * @throws ValidationException
     */

    public function index()
    {
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();

        $carts = Cart::join('users', 'carts.vendor', '=', 'users.id')
            ->join('food', 'carts.food_id', '=', 'food.id')
            ->join('categories', 'food.category', '=', 'categories.id')
            ->where('carts.checkout', 0)
            ->where('carts.order_by', Auth::user()->id)
            ->select(
                'carts.id as cart_id',
                'carts.food_id',
                'carts.quantity',
                'users.name as user_name',
                'food.name as food_name',
                'food.price_per_quantity',
                'food.discount',
                'food.image',
                'categories.name as category_name'
            )
            ->get();

//        return $carts;

//        $cart = Cart::where('checkout', 0)->where('order_by', Auth::user()->id)->get();
        return view('pages.user.cart', compact('carts', 'count'));
    }

    public function store(Request $request)
    {
        if ($request->quantity <= 0) {
            return response()->json(['message' => 'Item cannot be zero or negative'], 422);
        }

        $cart = [
            'order_by' => Auth::user()->id,
            'food_id' => $request->food,
            'quantity' => $request->quantity,
            'vendor' => Food::find($request->food)->vendor
        ];
        Cart::create($cart);
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();
        return $count;
    }

    public function update(Request $request)
    {
        $cart = Cart::findOrFail($request->cart_id);
        $cart->quantity = $request->quantity;
        $cart->save();
        return response()->json(['message' => 'Cart updated successfully'], 200);
    }

    public function destroy($cartId)
    {
        $cart = Cart::findOrFail($cartId);
        $cart->delete();
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();
        return response()->json(['message' => $count]);
    }
}
