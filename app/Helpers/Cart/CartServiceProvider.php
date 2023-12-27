<?php

namespace App\Helpers\Cart;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('cart', fn() => new CartService());
    }
}
