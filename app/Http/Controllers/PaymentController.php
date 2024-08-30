<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('order')->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        return view('payments.create', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|in:Cash,Bank Transfer,Credit Card,E-Wallet',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date',
            'status' => 'required|in:Pending,Completed,Failed',
        ]);

        Payment::create($request->all());
        return redirect()->route('payments.index')->with('success','Payment Created Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $order = Order::all();
        return view('orders.edit', compact('payment','order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|in:Cash,Bank Transfer,Credit Card,E-Wallet',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'status' => 'required|in:Pending,Completed,Failed',
        ]);
        $payment->update($request->all());
        return redirect()->route('payments.index')->with('success','Payment Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success','Payment Deleted Succesfully');
    }
}
