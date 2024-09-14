<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('store')->get();
        return view('employees.index', compact('employees'));
    }
    public function create()
    {
        $stores = Store::all();
        return view('employees.create', compact('stores'));
    }
    public function store(Request $request)
    {
     $employee=Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'store_id' => $request->store_id,
        ]);

        return redirect()->route('employees.index');
    }
    public function edit(Employee $employee)
    {
        $stores = Store::all();
        return view('employees.edit', compact('employee', 'stores'));
    }
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'password' => 'nullable|string|min:8|confirmed',
            'store_id' => 'required|exists:stores,id',
        ]);

        $employee->name = $request->name;
        $employee->email = $request->email;
        if ($request->filled('password')) {
            $employee->password = Hash::make($request->password);
        }
        $employee->store_id = $request->store_id;
        $employee->save();

        return redirect()->route('employees.index');
    }
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index');
    }
}