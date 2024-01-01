<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::query()->whereUserId(auth()->id())->latest()->paginate(10);

        return view('dashboard', compact('orders'));
    }
}
