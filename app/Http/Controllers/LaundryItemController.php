<?php

namespace App\Http\Controllers;

use App\Models\LaundryItem;
use App\Http\Requests\StoreLaundryItemsRequest;
use App\Http\Requests\UpdateLaundryItemsRequest;

class LaundryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLaundryItemsRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaundryItemsRequest $request, LaundryItem $laundryItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaundryItem $laundryItem)
    {
        //
    }
}
