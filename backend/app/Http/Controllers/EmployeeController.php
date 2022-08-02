<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEmployeeRequest;
use App\Models\Company;

class EmployeeController extends Controller
{
    public function create_employee(AddEmployeeRequest $request)
    {
        $company = Company::findOrFail($request->company_id);

        $employee = $company->employees()->create($request->validated());

        return response()->json($employee, 200);
    }
}
