<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LaundryItem;
use App\Models\Order;
use Illuminate\Http\Request;

class LaundryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LaundryItem::query()->with(['order.customer']);

        if ($search = $request->input('search')) {
            $query->whereHas('order.customer',function ($query) use ($search) {
                $query->where('name','like','%'. $search .'%');
        })->orWhere('item_name','like','%'. $search .'%')
          ->orWhereRaw('CAST (quantity as CHAR) like?',['%'. $search .'%']);
        }

        $laundryItems = $query->simplePaginate(5);
        return view('laundryItems.index', compact('laundryItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::whereHas('orders')->get();
        return view('laundryItems.create', compact('customers'));
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
        $orders = Order::find($request->order_id);

        LaundryItem::create([
            'order_id' => $request->order_id,
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'weight' => $request->weight,
        ]);
        return redirect()->route('laundryItems.index')->with('success', 'Laundry item Created successfully.');
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
        $orders = Order::with('customer')->get();
        return view('laundryItems.edit', compact('laundryItem', 'orders'));
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
        $orders = Order::find($request->order_id);

        $laundryItem->update([
            'order_id' => $request->order_id,
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'weight' => $request->weight,
        ]);
        return redirect()->route('laundryItems.index')->with('success', 'Laundry item Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaundryItem $laundryItem)
    {
        $laundryItem->delete();
        return redirect()->route('laundryItems.index')->with('success', 'Laundry Item Deleted Succesfully');
    }
}
