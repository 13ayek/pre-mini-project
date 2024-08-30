<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAssignment;
use App\Models\Order;
use Illuminate\Http\Request;

class EmployeeAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeAssignments = EmployeeAssignment::with('employee','orders')->get();
        return view('employeeAssignments.index', compact('employeeAssignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $orders = Order::all();
        return view('employeeAssignment.create', compact('employees','orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'order_id' => 'required|exists:orders,id',
            'assigned_date' => 'required|date',
        ]);
        EmployeeAssignment::create($request->all());
        return redirect()->route('employeeAssignment.index')->with('success','Employee Assignment Created Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeAssignment $employeeAssignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeAssignment $employeeAssignment)
    {
        $employees = Employee::all();
        $orders = Order::all();
        return view('employeeAssignments', compact('employeeAssignment','orders','employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeAssignment $employeeAssignment)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'order_id' => 'required|exists:orders,id',
            'assigned_date' => 'required|date',
        ]);
        $employeeAssignment->update($request->all());
        return redirect()->route('employeeAssignments.index')->with('success','Employee Assignment Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeAssignment $employeeAssignment)
    {
        $employeeAssignment->delete();
        return redirect()->route('employeeAssignments.')->with('success','Employee Assignment Deleted Succesfully');
    }
}
