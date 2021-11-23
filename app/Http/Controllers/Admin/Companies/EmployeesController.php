<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\companies\employees\StoreEmployeeRequest;
use App\Http\Requests\companies\employees\UpdateEmployeeRequest;
use App\Http\Requests\companies\employees\ShowEmployeesAPIRequest;
use PhpParser\Node\Stmt\TryCatch;
use symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class EmployeesController extends Controller
{

    public function index()
    {
        return view('admin.employees.index', ['employees' => employees::all()]);
    }

    public function create(Companies $company)
    {
        return view('admin.companies.employee.create', compact('company'));
    }

    public function store(StoreEmployeeRequest $request, Companies $company)
    {
        $request['created_by_id'] = Auth::user()->id;
        $employee = Employees::Create(['company_id' => $company->id] + $request->validated());

        return redirect()->route('admin.companies.show', $company->id)->with('success', 'Successfully created a new company!');
    }
    public function edit(Employees $employee)
    {
        return view('admin.companies.employee.edit', compact('employee'));
    }
    public function update(UpdateEmployeeRequest $request, Employees $employee)
    {
        $request['created_by_id'] = Auth::user()->id;
        $employee->update($request->validated());
        return redirect()->route('admin.companies.edit', $employee->company_id)->with('success', 'succesfully edited employee details!');
    }

    public function destroy(Employees $employee)
    {
        $employee->delete();
        return back()->with('success', 'successfully deleted employee!');
    }

    public function showEmployeesApi(Request $request,Companies $company)
    {
        $employees = $company->employee;
        $data = compact('employees');
        $payload = JWTAuth::getPayLoad($request->token)->toArray();
        $companyId = explode("/", $request->getPathInfo())[1];
        if ($payload['sub'] != $companyId) {
            return response()->json(['status' => 'Not Authorized']);
        }
        return response()->json($data, 200);
    }

    public function open()
    {
        $data = "This data is open and can be accessed without the client being authenticated";
        return response()->json(compact('data'),200);

    }
}
