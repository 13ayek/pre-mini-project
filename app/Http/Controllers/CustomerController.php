<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view("customers.index", compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("customers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email|max:255|unique:customers,email,except,id',
            'phone' => 'required|integer|max:12|unique:customers,phone,except,id',
            'address' => 'required|string|max:255',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success','Customer Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'email' => ['required','email',Rule::unique('customers')->ignore($customer->id)],
            'phone' => ['required','integer','max:12', 'regex:/^[0-9]+$/',Rule::unique('customers')->ignore($customer->id)],
            'address' => ['required','string','max:255'],
        ],
        [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'This email is already taken',
            'phone.required' => 'Phone number is required',
            'phone.regex' => 'The phone number value cannot be below 0',
            'phone.unique'=> 'This phone number is already taken',
        ]);
        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success','Customer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if ($customer->orders()->count() > 0) {
            // Jika masih ada orders, berikan pesan error
            return redirect()->route('customers.index')
                             ->with('error', 'Customers cannot be deleted because they still have orders');
        }

        $customer->delete();

        return redirect()->route('customers.index')->with('success','Customer Deleted Successfully');
    }
    
}
