<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::with('userSubscription.user')->get();
    }

    public function show($id)
    {
        $payment = Payment::with('userSubscription.user')->findOrFail($id);
        return response()->json($payment);
    }
}
