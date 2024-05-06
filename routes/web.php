<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Page\User\HomeController;
use App\Http\Controllers\Page\User\CartController;
use App\Http\Controllers\Page\User\OrderController;
use App\Http\Controllers\Page\User\PaymentController;
use App\Http\Controllers\Page\Vendor\FoodItemController;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return view('pages.login');
    })->name('login');
    Route::get('/register', function () {
        return view('pages.register');
    });
    Route::post('/register', [AuthController::class, 'store']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->post('/logout', function (){
    Auth::logout();
    return redirect('/login');
});

Route::group(['middleware' => ['auth', 'is.user']], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/food/{food}', [HomeController::class, 'get']);
    Route::get('/search', [HomeController::class, 'search']);
    Route::POST('/food/add_to_cart', [CartController::class, 'store']);
    Route::get('/my-cart', [CartController::class, 'index']);
    Route::put('/update-cart', [CartController::class, 'update']);
    Route::delete('/remove-cart-item/{cartId}', [CartController::class, 'destroy']);
    Route::get('/location', function (){
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();
        return view('pages.user.location', compact('count'));
    });
    Route::post('/place-order', [PaymentController::class, 'store']);
    Route::get('/phone', function (){
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();
        return view('pages.user.payment-phone', compact('count'));
    });
    Route::post('/otp', function (){
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();
        return view('pages.user.payment-otp', compact('count'));
    });
    Route::post('/pin', function (){
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();
        $amounts = Order::where('order_by', Auth::user()->id)
            ->where('payment_status', 'unpaid')
            ->get();
        $totalAmount = 0;
        foreach ($amounts as $amount){
            $totalAmount += intval($amount->amount);
        }
        return view('pages.user.payment-pin', compact('count', 'totalAmount'));
    });
    Route::post('/paid', function (Request $request){
        Order::where('order_by', Auth::user()->id)->update(['payment_status' => 'paid']);
        return "success";
    });
    Route::get('/my-orders', [OrderController::class, 'index']);
    Route::put('/receive-order', [OrderController::class, 'receive']);
    Route::get('/compare', function (){
        $count = Cart::where('order_by', Auth::user()->id)
            ->where('checkout', 0)
            ->count();
        $foods = \App\Models\Food::all();
        return view('pages.user.compare', compact('count', 'foods'));
    });
    Route::get('/fetch-food-data', [HomeController::class, 'food_data']);
});

Route::group(['middleware' => ['auth', 'is.vendor']], function (){
   Route::get('/vendor/create', function (){
       $categories = Category::all();
       return view('pages.vendor.create', compact('categories'));
   });
   Route::post('vendor/add-new-item', [FoodItemController::class, 'store']);
    Route::get('/vendor/orders', [\App\Http\Controllers\Page\Vendor\OrderController::class, 'index']);
    Route::put('/vendor/update', [\App\Http\Controllers\Page\Vendor\OrderController::class, 'update']);
});

Route::group(['middleware' => ['auth', 'is.delivery.man']], function (){
    Route::get('/me/dashboard', [\App\Http\Controllers\Page\DeliveryMan\HomeController::class, 'index']);
    Route::get('/me/accept/{order_token}', [\App\Http\Controllers\Page\DeliveryMan\HomeController::class, 'acceptOrder']);
    Route::get('/me/deliveries', [\App\Http\Controllers\Page\DeliveryMan\HomeController::class, 'deliveries']);
    Route::put('/me/update-order', [\App\Http\Controllers\Page\DeliveryMan\HomeController::class, 'update_order']);
    Route::get('/me/cancel/{order_token}', [\App\Http\Controllers\Page\DeliveryMan\HomeController::class, 'cancel']);
});
