<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingredients extends Model
{
    use HasFactory;
    protected $fillable = ['food_id', 'ingredients'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
