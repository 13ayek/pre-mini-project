<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone_number', 'like', '%' . $search . '%')
                  ->orWhere('position', 'like', '%' . $search . '%');
        }
        $employees = $query->simplePaginate(5);
        return view("employees.index", compact("employees"));
    }

    public function create()
    {
        return view("employees.create");
    }

    public function store(Request $request)
    {
        // Validasi input termasuk file gambar
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:employees,email',
            'phone_number' => 'required|string|min:11|max:12|unique:employees,phone_number',
            'image' => 'nullable|mimes:jpeg,png,jpg|max:5048', // menggunakan mimes untuk validasi format file
            'position' => 'required|string|max:50',
            'hire_date' => 'required|date',
        ], [
            'name.required' => 'The name is required.',
            'name.max' => 'The name must not exceed 100 characters.',
            'position.required' => 'The position is required.',
            'position.max' => 'The position must not exceed 50 characters.',
            'phone_number.required' => 'The phone number is required.',
            'phone_number.min' => 'The phone number value must be more than 11 digits',
            'phone_number.max' => 'The phone number value Cannot be more than 12 digits',
            'phone_number.unique' => 'The phone number is already in use.',
            'image.mimes' => 'The image must be a valid format (jpeg, png, jpg).',
            'image.max' => 'The image size must not exceed 5 MB.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email is already in use.',
            'hire_date.required' => 'The hire date is required.',
            'hire_date.date' => 'The hire date must be a valid date.',
        ]);

        // Ambil data validasi
        $validateData = $request->only('name', 'position', 'phone_number', 'email', 'hire_date');

        // Jika ada file gambar, simpan file gambar tersebut
        if ($request->hasFile('image')) {
            $validateData['image'] = $request->file('image')->store('employee_images', 'public');
        }

        // Buat entitas Employee baru dengan data validasi
        Employee::create($validateData);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('employees.index')->with('success', 'Employee Created Successfully');
    }

    public function show($id)
    {
        $employee = Employee::all()->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'position' => 'required|string|max:50',
            'phone_number' => ['required', 'string','min:11', 'max:12', Rule::unique('employees', 'phone_number')->ignore($employee->id)],
            'email' => ['required', 'email', 'max:100', Rule::unique('employees', 'email')->ignore($employee->id)],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5048'],
            'hire_date' => 'required|date',
        ], [
            'name.required' => 'The name is required.',
            'name.max' => 'The name must not exceed 100 characters.',
            'position.required' => 'The position is required.',
            'position.max' => 'The position must not exceed 50 characters.',
            'phone_number.required' => 'The phone number is required.',
            'phone_number.min' => 'The phone number value must be more than 11 digits',
            'phone_number.max' => 'The phone number value Cannot be more than 12 digits',
            'phone_number.unique' => 'The phone number is already in use.',
            'image.image' => 'The image must be a valid image format (jpeg, png, jpg).',
            'image.mimes' => 'The image format must be jpeg, png, or jpg.',
            'image.max' => 'The image size must not exceed 5 MB.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email is already in use.',
            'hire_date.required' => 'The hire date is required.',
            'hire_date.date' => 'The hire date must be a valid date.',
        ]);

        $validatedData = $request->only('name', 'position', 'phone_number', 'email', 'hire_date');
        if ($request->hasFile('image')) {
            if ($employee->image) {
                Storage::disk('public')->delete($employee->image);
            }
            $validatedData['image'] = $request->file('image')->store('employee_images', 'public');
        }
        $employee->update($validatedData);
        return redirect()->route('employees.index')->with('success', 'Employee Updated Successfully');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->employeeAssignments()->exists()) {
            return redirect()->route('employees.index')
                             ->withErrors('Employee cannot be deleted because they still have Contract.');
        }
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee Deleted Successfully');
    }
}
