<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LaundryItem;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mulai query pada model Order
        $query = Order::query()->with(['customer', 'service']);

        // Cek apakah ada input pencarian
        if ($search = $request->input('search')) {
            $query->whereHas('customer', function ($q) use ($search) {
                // Pencarian berdasarkan nama, email, atau alamat customer
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('service', function ($q) use ($search) {
                // Pencarian berdasarkan nama service
                $q->where('service_name', 'like', '%' . $search . '%');
            })->orWhere('order_date', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%')
                ->orWhereRaw('CAST(total_price as CHAR)like?', ['%' . $search . '%']);
        }

        // Gunakan pagination untuk hasil query
        $orders = $query->simplePaginate(5);

        // Kembalikan view dengan data orders
        return view("orders.index", compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::all();
        $service = Service::all();
        $laundryItems = LaundryItem::all();
        return view('orders.create', compact('customer', 'service', 'laundryItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'order_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:Pending,In Progress,Completed,Cancelled',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0',
        ]);

        $service = Service::find($request->service_id);
        $perkilo = 5000;
        $total_price = $request->weight * $perkilo + $service->price;

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'order_date' => $request->order_date,
            'status' => $request->status,
            'total_price' => $total_price,
        ]);

        LaundryItem::create([
            'order_id' => $order->id,
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'weight' => $request->weight,
        ]);


        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::with(['customer', 'service', 'laundryItems'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
{
    $customers = Customer::all();
    $services = Service::all();
    $laundryItems = LaundryItem::where('order_id', $order->id)->get();

    return view('orders.edit', compact('order', 'customers', 'services', 'laundryItems'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, Order $order)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'service_id' => 'required|exists:services,id',
        'order_date' => 'required|date|after_or_equal:today',
        'status' => 'required|in:Pending,In Progress,Completed,Cancelled',
        'item_name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'weight' => 'required|numeric|min:0',
    ]);

    $service = Service::findOrFail($request->service_id);
    $perkilo = 5000;
    $total_price = $request->weight * $perkilo + $service->price;

    $order->update([
        'customer_id' => $request->customer_id,
        'service_id' => $request->service_id,
        'order_date' => $request->order_date,
        'status' => $request->status,
        'total_price' => $total_price,
    ]);

    $laundryItem = $order->laundryItems()->firstOrFail();
    $laundryItem->update([
        'item_name' => $request->item_name,
        'quantity' => $request->quantity,
        'weight' => $request->weight,
    ]);

    return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order Deleted Succesfully');
    }
}
