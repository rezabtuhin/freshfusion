<?php

namespace App\Http\Controllers\Page\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Food;
use App\Models\Ingredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $foods = Food::paginate(25);
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();
        return view('pages.user.home', compact('foods', 'count'));
    }

    public function get(Food $food)
    {
        $ingredients = Ingredients::where('food_id', $food->id)->pluck('ingredients');
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();
        return view('pages.user.food', compact('food', 'ingredients', 'count'));
    }
}
