<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($search = $request->input('search')) {
            $query->where('name','like','%'. $search .'%')
                  ->orWhere('email','like','%'. $search .'%')
                  ->orWhere('phone_number','like','%'. $search .'%')
                  ->orWhere('position', 'like', '%'. $search .'%');
        }
        $employees = $query->simplePaginate(5);
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
            'phone_number' => 'required|string|max:15|unique:employees,phone_number',
            'email' => 'required|email|max:100|unique:employees,email',
            'hire_date' => 'required|date',
        ]);

        // Pastikan semua field yang diperlukan termasuk 'email' dimasukkan di sini
        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee Created Successfully');
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
            'phone_number' => ['required', 'string', 'max:15', Rule::unique('employees', 'phone_number')->ignore($employee->id)],
            'email' => ['required', 'email', 'max:100', Rule::unique('employees', 'email')->ignore($employee->id)],
            'hire_date' => 'required|date',
        ]);
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee Deleted Succesfully');
    }
}
