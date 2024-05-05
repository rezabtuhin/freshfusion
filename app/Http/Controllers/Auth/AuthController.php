<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        if ($request->role !== 'Vendor'){
            $request['phone'] = "+880".$request['phone'];
            User::create($request->all());
            return redirect('/login');
        }
        else{
            $requestData = $request->all();
            $requestData['phone'] = "+880".$requestData['phone'];
            $fileName = time().$request->file('banner')->getClientOriginalName();
            $path = $request->file('banner')->storeAs('images', $fileName, 'public');
            $requestData['banner'] = '/storage/'.$path;
            User::create($requestData);
            return redirect('/login');
        }
    }

    public function login(Request $request)
    {
//        dd($request->all());
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)){
            $user = Auth::user();
            $request->session()->regenerate(true);
            if ($user->role === 'Vendor'){
                return redirect('/vendor/create');
            }
            else if ($user->role === 'Delivery Man'){
                return redirect('/me/dashboard');
            }
            else{
                return redirect('/');
            }
        }
        return redirect('/');
    }
}
