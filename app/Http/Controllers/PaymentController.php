<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function payment()
    {
        $cartItem = Cart::all();
        if ($cartItem->count()) {
            $price = $cartItem->sum(function ($cart) {
                return $cart['product']->price * $cart['quantity'];
            });

            $orderItems = $cartItem->mapWithKeys(function ($cart) {
                return [$cart['product']->id => ['quantity' => $cart['quantity']]];
            });

            $order = auth()->user()->orders()->create([
                'status' => 'unpaid',
                'price' => $price
            ]);

            $order->products()->attach($orderItems);

            return view('payment.index')->with(['order' => $order]);
        }

        return back();
    }

    public function handle(Request $request)
    {
        $validData = $request->validate([
            'result' => ['required', 'boolean'],
            'order' => ['required', 'exists:orders,id'],
        ]);
        $result = $validData['result'];
        $orderId = $validData['order'];

        if ($orderId) {
            $order = Order::query()->findOrFail($orderId);
            $products = $order->products;
            if ($result) {
                foreach ($products as $product) {
                    $product->decrementQuantity();
                }
                $order->setStatus(Order::STATUS_PREPARATION);
                $resnumber = Str::random(10);
                Payment::create([
                    'order_id' => $orderId,
                    'status' => Payment::STATUS_PAID,
                    'resnumber' => $resnumber,
                ]);
                return redirect()->route('payment.success', $resnumber);
            } else {
                return redirect()->route('cart');
            }
        } else {
            return redirect()->route('cart');
        }
    }

    public function success($resnumber)
    {
        return view('payment.thanks')->with(['resnumber' => $resnumber]);
    }
}
