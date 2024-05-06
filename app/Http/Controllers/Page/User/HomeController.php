<?php

namespace App\Http\Controllers\Page\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Food;
use App\Models\Ingredients;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\NoReturn;

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

    public function food_data(Request $request)
    {
        $food = Food::find($request->food_id);
        return response()->json([
            "name" => $food->name,
            "image" => $food->image,
            "vendor" => User::find($food->vendor)->name,
            "category" => Category::find($food->category)->name,
            "price" => $food->price_per_quantity,
            "availability" => $food->availability == 1 ? "YES" : "NO",
            "description" => $food->description,
            "ingredients" => Ingredients::where('food_id', $food->id)->pluck('ingredients')
        ], 200);
    }
//    public function search(Request $request)
//    {
//
//    }
}
