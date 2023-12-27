<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Product extends Model
{
    use HasFactory;

    const PRODUCT_EDIT = 'product-edit';
    const PRODUCT_INDEX = 'product-index';
    const PRODUCT_CREATE = 'product-create';
    const PRODUCT_DELETE = 'product-delete';

    protected $fillable = [
        'name',
        'title',
        'slug',
        'price',
        'quantity',
        'colors',
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imgable');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function incrementQuantity(int $quantity = 1): bool
    {
        return $this->update(['quantity' => $this->quantity + 1]);
    }

    public function decrementQuantity(int $quantity = 1): bool
    {
        return $this->update(['quantity' => $this->quantity - 1]);
    }
}
