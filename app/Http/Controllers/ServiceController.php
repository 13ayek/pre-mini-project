<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view("services.index", compact("services"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("services.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_name'=> ['required','string','max:255'],
            'description' => ['nullable','string','max:255'],
            'price'       => ['required','numeric','min:1'],
        ]);
        Service::create($request->all());

        return redirect()->route('services.index')->with('success','Service Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'service_name'=> ['required','string','max:255'],
            'description' => ['nullable','string','max:255'],
            'price'       => ['required','numeric','min:1'],
        ]);
        $service->update($request->all());

        return redirect()->route('services.index')->with('success','Service Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if ($service->orders()->count() > 0) {
            // Jika masih ada orders, berikan pesan error
            return redirect()->route('services.index')
                             ->with('error', 'Services cannot be deleted because they still have orders');
        }

        $service->delete();

        return redirect()->route('services.index')->with('success','Sevice Deleted Successfully');
    }

}
