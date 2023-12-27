<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class CartController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function cart()
    {
        return view('cart');
    }

    /**
     * @param Product $product
     * @return Application|RedirectResponse|Redirector
     */
    public function addToCart(Request $request, Product $product)
    {
        if (Cart::has($product)) {
            if (Cart::count($product) < $product->inventory)
                Cart::update($product, 1);
        } else {
            Cart::put(
                [
                    'quantity' => 1,
                    'color' => $request->input('color'),
                ],
                $product
            );
        }
        return redirect('/cart');
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function quantityChange(Request $request)
    {
        $data = $request->validate([
            'quantity' => 'required',
            'id' => 'required',
        ]);
        if (Cart::has($data['id'])) {
            Cart::update($data['id'], [
                'quantity' => $data['quantity']
            ]);
            return response(['status' => 'success']);
        }
        return response(['status' => 'error'], 404);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function deleteFromCart($id)
    {
        Cart::delete($id);
        return back();
    }
}
