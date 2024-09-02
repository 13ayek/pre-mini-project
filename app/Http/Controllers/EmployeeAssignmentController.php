<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Day;
use App\Models\EmployeeAssignment;
use App\Models\Service; // Pastikan nama model sesuai dengan tabel
use Illuminate\Http\Request;

class EmployeeAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeAssignments = EmployeeAssignment::with('employee', 'service')->get();
        $schedule = Schedule::all();
        $days = Day::all();
        return view('employeeAssignments.index', compact('employeeAssignments', 'schedule', 'days'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $services = Service::all(); // Pastikan nama model sesuai
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        return view('employeeAssignments.create', compact('employees', 'services', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $employeeAssignment = EmployeeAssignment::create([
            'employee_id' => $validated['employee_id'],
            'service_id' => $validated['service_id'],
        ]);

        $rules = [
            'days.*' => 'required',
        ];

        $masseges = [
            'days.*.required' => 'days must be filled'
        ];
        $request->validate($rules, $masseges);

        $employee_assignment_id = $employeeAssignment->id;
        $days = $request->input('days',[]);

        foreach($days as $value) {
            $schedule = Schedule::create([
                'employee_assignments_id' => $employee_assignment_id,
                'days_id' => $value,
            ]);
        }


        return redirect()->route('employeeAssignments.index')->with('success', 'Employee Assignment Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeAssignment $employeeAssignment)
    {
        return view('employeeAssignments.show', compact('employeeAssignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeAssignment $employeeAssignment)
    {
        $employees = Employee::all();
        $services = Service::all(); // Pastikan nama model sesuai
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        return view('employeeAssignments.edit', compact('employeeAssignment', 'employees', 'services', 'days'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeAssignment $employeeAssignment)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'service_id' => 'required|exists:services,id',
            'schedule' => 'required|array',
            'schedule.*' => 'string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
        ]);

        $employeeAssignment->update([
            'employee_id' => $validated['employee_id'],
            'service_id' => $validated['service_id'],
            'schedule' => $validated['schedule'],
        ]);

        return redirect()->route('employeeAssignments.index')->with('success', 'Employee Assignment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeAssignment $employeeAssignment)
    {
        $employeeAssignment->delete();
        return redirect()->route('employeeAssignments.index')->with('success', 'Employee Assignment Deleted Successfully');
    }
}
