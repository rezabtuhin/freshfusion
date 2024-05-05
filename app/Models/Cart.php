<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_by',
        'food_id',
        'quantity',
        'checkout',
        'vendor',
        'order_token',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'order_by');
    }
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor');
    }
    // Define the relationship with the Food model
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    // Define the relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_token');
    }
}
