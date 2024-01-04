<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Gate::allows(Order::ORDER_INDEX)) {
            return redirect()->route('admin.index');
        }
        $query = $request->input('search');

        $orders = Order::query()->where('uuid', 'like', '%' . $query . '%')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::query()->findOrFail($id);

        if (!Gate::allows(Order::ORDER_EDIT)) {
            return redirect()->route('admin.index');
        } elseif (!$order->payments->count()) {
            return redirect()->route('admin.orders.index')->withErrors('این سفارش پرداخت نشده است.');
        }


        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::query()->findOrFail($id);

        if (!Gate::allows(Order::ORDER_EDIT)) {
            return redirect()->route('admin.index');
        } elseif (!$order->payments->count()) {
            return redirect()->route('admin.orders.index')->withErrors('این سفارش پرداخت نشده است.');
        }

        $validData = $request->validate([
            'tracking_serial' => ['nullable', 'integer'],
            'status' => ['required', 'string', 'in:' . Order::STATUS_UNPAID . ',' . Order::STATUS_PREPARATION . ',' . Order::STATUS_POSTED . ',' . Order::STATUS_RECEIVED . ',' . Order::STATUS_CANCELED],
        ], [
            'tracking_serial.integer' => 'کد رهگیری باید حتما عددی باشد.',

            'status.required' => 'وضعیت باید حتما وارد شده باشد.',
            'status.string' => 'وضعیت باید حتما کارکتر باشد.',
            'status.in' => 'وضعیت صحیح نیست.',
        ]);

        if (is_null($validData['tracking_serial'])) {
            if ($validData['status'] == Order::STATUS_POSTED or $validData['status'] == Order::STATUS_RECEIVED) {
                return back()->withErrors('در این وضعیت، کد رهگیری اجباری است.');
            }
        }

        $order->update($validData);

        return redirect()->route('admin.orders.index');
    }
}
