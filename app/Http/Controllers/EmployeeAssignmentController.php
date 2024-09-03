<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAssignment;
use App\Models\Service;
use Illuminate\Http\Request;

class EmployeeAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data assignments dengan relasi ke employee dan service
        // Mengelompokkan berdasarkan employee_id untuk menghindari duplikasi
        $employeeAssignments = EmployeeAssignment::with(['employee', 'service'])
            ->get()
            ->groupBy('employee_id');

        return view('employeeAssignments.index', compact('employeeAssignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $services = Service::all();
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
            'days' => 'required|array',
        ]);


        $existingAssignment = EmployeeAssignment::where('employee_id', $validated['employee_id'])
            ->first();

        if ($existingAssignment) {
            // Update existing assignment jika sudah ada
            return redirect()->route('employeeAssignments.index')->with('error', 'Employee already exists');
        } else {
            foreach ($validated['days'] as $day) {
                // Cek apakah assignment sudah ada, jika sudah ada maka akan lanjut ke if(ERROR) dan jika belum ada akan lanjut ke else(SUCCESS)

                // Jika tidak ada, buat baru
                EmployeeAssignment::create([
                    'employee_id' => $validated['employee_id'],
                    'service_id' => $validated['service_id'],
                    'day' => $day,
                ]);
            }
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
    $services = Service::all();
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    // Mengambil hari-hari yang sudah dipilih untuk karyawan dan layanan ini
    $selectedDays = EmployeeAssignment::where('employee_id', $employeeAssignment->employee_id)
                    ->where('service_id', $employeeAssignment->service_id)
                    ->pluck('day')
                    ->toArray();

    return view('employeeAssignments.edit', compact('employeeAssignment', 'employees', 'services', 'days', 'selectedDays'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeAssignment $employeeAssignment)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'service_id' => 'required|exists:services,id',
            'days' => 'required|array',
        ]);

        // Hapus semua assignment hari yang sudah ada untuk employee dan service ini
        EmployeeAssignment::where('employee_id', $employeeAssignment->employee_id)
            ->where('service_id', $employeeAssignment->service_id)
            ->delete();

        // Tambahkan assignment baru berdasarkan input yang divalidasi
        foreach ($validated['days'] as $day) {
            EmployeeAssignment::create([
                'employee_id' => $validated['employee_id'],
                'service_id' => $validated['service_id'],
                'day' => $day,
            ]);
        }

        return redirect()->route('employeeAssignments.index')->with('success', 'Employee Assignment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeAssignment $employeeAssignment)
    {
        EmployeeAssignment::where('employee_id', $employeeAssignment->employee_id)->delete();
        return redirect()->route('employeeAssignments.index')->with('success', 'Employee Assignment Deleted Successfully');
    }
}
