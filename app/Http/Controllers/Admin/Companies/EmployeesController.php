<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\companies\employees\StoreEmployeeRequest;
use App\Http\Requests\companies\employees\UpdateEmployeeRequest;

class EmployeesController extends Controller
{

    public function index()
    {   
        // dd(employees::latest()->paginate(10));
        return view('admin.employees.index', ['employees' => employees::latest()->all()]);
    }

    public function create(Companies $company)
    {
        return view('admin.companies.employee.create', compact('company'));
    }

    public function store(StoreEmployeeRequest $request, Companies $company)
    {
        $employee = Employees::Create(['company_id' => $company->id] + $request->validated());

        return redirect()->route('admin.companies.show', $company->id)->with('success', 'Successfully created a new company!');
    }
    public function edit(Employees $employee)
    {
        return view('admin.companies.employee.edit', compact('employee'));
    }
    public function update(UpdateEmployeeRequest $request, Employees $employee)
    {
        $employee->update($request->validated());
        return redirect()->route('admin.companies.edit', $employee->company_id)->with('success', 'succesfully edited employee details!');
    }

    public function destroy(Employees $employee)
    {
        $employee->delete();
        return back()->with('success', 'successfully deleted employee!');
    }
}
