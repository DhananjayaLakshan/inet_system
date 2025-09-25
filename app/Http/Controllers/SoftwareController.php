<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSoftwareRequest;
use App\Http\Requests\UpdateSoftwareRequest;
use App\Models\Company;
use App\Models\Software;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    public function index ()
    {
        $softwares = Software::with('company')->latest()->paginate(10);
        return view('employee.software_details', compact('softwares'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('employee.add_softwareDetails', compact('companies'));
    }

    public function store (StoreSoftwareRequest $request)
    {
        Software::create($request->validated());
        return redirect()
               ->route('employee.softwares.index')
               ->with('success','Software added successfully');
    }

    public function show()
    {}

    public function edit(Software $software)
    {
        $companies = Company::all();
        return view('employee.edit_softwares', compact('software','companies'));
    }

    public function update (UpdateSoftwareRequest $request, Software $software)
    {
        $software->update($request->validated());
        return redirect()
               ->route('employee.softwares.index')
               ->with('success','Software updated successfully');
    }

    public function destroy (Software $software)
    {
        $software->delete();
        return redirect()
               ->route('employee.softwares.index')
               ->with('success','Software deleted successfully');

    }
}
