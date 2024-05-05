<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price_per_quantity',
        'description',
        'discount',
        'image',
        'availability',
        'category',
        'vendor',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor');
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredients::class);
    }
}
