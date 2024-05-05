<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_token',
        'order_taken_by',
        'current_status',
        'order_by',
        'payment_status',
        'amount',
        'location',
        'vendor',
        'delivered',
    ];

    // Define the relationship with the User model for order_taken_by
    public function user()
    {
        return $this->belongsTo(User::class, 'order_taken_by');
    }

    // Define the relationship with the User model for order_id
    public function orderUser()
    {
        return $this->belongsTo(User::class, 'order_by');
    }

    // Define the relationship with the User model for vendor
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor');
    }
}
