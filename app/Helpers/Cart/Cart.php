<?php

namespace App\Helpers\Cart;

use Illuminate\Support\Facades\Facade;

/**
 * @method static put(array $array, \App\Models\Product $product)
 * @method static has(\App\Models\Product $product)
 * @method static get()
 * @method static all()
 * @method static update(\App\Models\Product $product, mixed $options)
 * @method static delete($id)
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}
