<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view("employees.index", compact("employees"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("employees.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'position' => 'required|string|max:50',
            'phone_number' => 'required|string|max:15|unique:employees,phone_number,except,id',
            'email' => 'required|email|max:100|unique:employees,email,except,id',
        ]);
        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success','Employees Created Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'position' => 'required|string|max:50',
            'phone_number' => ['required','string','max:15',Rule::unique('phone_number')->ignore($employee->id)],
            'email' => ['required','email','max:100',Rule::unique('email')->ignore($employee->id)],
        ]);
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success','Employee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success','Employee Deleted Succesfully');
    }
}
