<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Payment::query()->with(['order.customer','order']);
        if ($search = $request->input('search')) {
            $query->whereHas('order.customer',function ($query) use ($search) {
                $query->where('name','like','%'. $search .'%');
            })->orWhere('order',function ($query) use ($search) {
                $query->where('status','like','%'. $search .'%')
                      ->orWhereRaw('CAST(total as CHAR) like?', ['%'. $search .'%']);
            })->orWhere('payment_method','like','%'. $search .'%');
        }
        $payments = $query->simplePaginate(5);
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::with('customer')->get();
        $customers = Customer::all();
        return view('payments.create', compact('orders', 'customers'));
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
            'payment_date' => 'required|date|after_or_equal:today',
        ]);

        $order = Order::find($request->order_id);

        Payment::create([
            'order_id' => $request->order_id,
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'refund' => $request->amount - $order->total_price,
            'payment_date' => $request->payment_date,
        ]);
        return redirect()->route('payments.index')->with('success', 'Payment Created Successfully');
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
        $orders = Order::with('customer')->get();
        $customers = Customer::all();
        return view('payments.edit', compact('payment', 'orders', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|in:Cash,Bank Transfer,Credit Card,E-Wallet',
            'amount' => 'required|numeric|min:1',
            'payment_date' => 'required|date|after_or_equal:today',
        ]);

        $orders = Order::find($request->order_id);

        $payment->update([
            'order_id' => $request->order_id,
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'refund' => $request->amount - $orders->total_price,
            'payment_date' => $request->payment_date,
        ]);
        return redirect()->route('payments.index')->with('success', 'Payment Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment Deleted Succesfully');
    }
}
