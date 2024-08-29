<?php

namespace App\Http\Controllers;

use App\Models\LaundryItem;
use App\Models\Order;
use Illuminate\Http\Request;

class LaundryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laundryItems = LaundryItem::with('orders')->get();
        return view('laundryItems.index', compact('laundryItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        return view('laundryItems.create', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'item_name' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0',
        ]);
        LaundryItem::create($request->all());
        return redirect()->route('laundryItems.index')->with('success','Laundry Item Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaundryItem $laundryItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaundryItem $laundryItem)
    {
        $orders = Order::all();
        return view('laundryItems.edit', compact('laundryItem','orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaundryItem $laundryItem)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'item_name' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0',
        ]);

        $laundryItem->update($request->all());
        return redirect()->route('laundry_items.index')->with('success', 'Laundry item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaundryItem $laundryItem)
    {
        $laundryItem->delete();
        return redirect()->route('laundryItems.index')->with('success','Laundry Item Deleted Succesfully');
    }
}
