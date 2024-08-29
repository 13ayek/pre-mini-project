<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('customer','service')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::all();
        $service = Service::all();
        return view('orders.create', compact('customer','service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'order_date' => 'required|date',
            'status' => 'required|in:Pending,In Progress,Completed,Cancelled',
            'total_price' => 'required|numeric|min:1',
        ]);

        Order::create($request->all());
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $customers = Customer::all();
        $service = Service::all();
        return view('orders.edit', compact('order','customers','services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'order_date' => 'required|date',
            'status' => 'required|in:Pending,In Progress,Completed,Cancelled',
            'total_price' => 'required|numeric|min:1',
        ]);
        $order->update($request->all());
        return redirect()->route('orders.index')->with('success','Order Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success','Order Deleted Succesfully');
    }
}
