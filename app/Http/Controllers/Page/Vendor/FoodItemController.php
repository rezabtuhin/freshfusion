<?php

namespace App\Http\Controllers\Page\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Ingredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $fileName = time().$request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('images', $fileName, 'public');
        $requestData['image'] = '/storage/'.$path;
        $ingredients = [];
        if (array_key_exists('ingredients', $requestData)){
            $ingredients = $requestData['ingredients'];
            unset($requestData['ingredients']);
        }
        $requestData['vendor'] = Auth::user()->id;
//        dd($requestData);
        $food = Food::create($requestData);
        $ingredientsArray = [];
        if (!empty($ingredients)){
            foreach ($ingredients as $ingredient){
                $ingredientsArray[] = [
                    "food_id" => $food->id,
                    "ingredients" => $ingredient
                ];
            }
            Ingredients::insert($ingredientsArray);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
