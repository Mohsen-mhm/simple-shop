<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows(Payment::PAYMENT_INDEX)) {
            return redirect()->route('admin.index');
        }

        $payments = Payment::query()->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }
}
