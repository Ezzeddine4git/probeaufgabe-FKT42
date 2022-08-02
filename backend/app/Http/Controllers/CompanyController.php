<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function get_all_companies_with_respective_employees()
    {
        $companies = Company::with('employees')->get();

        return response()->json($companies, 200);
    }

    public function create_company(AddCompanyRequest $request)
    {
        $company = Company::create($request->validated());

        return response()->json($company, 200);
    }
}
