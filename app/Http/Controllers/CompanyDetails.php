<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyDetails extends Controller
{
    public function index(){
        $companies = Company::latest()->paginate(10);
        return view('employee.company_details', compact('companies'));
    }

    public function create(){
        return view('employee.add_companyDetails');
    }

    public function store(StoreCompanyRequest $request){

        Company::create($request->validated());

        return redirect()
        ->route('employee.company-details.index')
        ->with('success', 'Company Details Added Successfully');

    }
    
    public function show($id){}

    public function edit(Company $company){
        return view('employee.edit_companyDetails', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company){

        $company->update($request->validated());

        return redirect()
        ->route('employee.company-details.index')
        ->with('success', 'Company details updated successfully!');
    }

    public function destroy(Company $company){

        $company->delete();

        return redirect()
        ->route('employee.company-details.index')
        ->with('success', 'Company deleted successfully!');
    }
}
