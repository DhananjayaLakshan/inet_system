<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHardwareRequest;
use App\Http\Requests\UpdateHardwareRequest;
use App\Models\Company;
use App\Models\Hardware;
use Illuminate\Http\Request;

class HardwareController extends Controller
{
    public function index()
    {
        $hardwares = Hardware::with('company')->latest()->paginate(10);
        return view('employee.hardware_details', compact('hardwares'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('employee.add_hardwareDetails', compact('companies'));
    }

    public function store(StoreHardwareRequest $request)
    {
        Hardware::create($request->validated());
        return redirect()
               ->route('employee.hardwares.index')
               ->with('success', 'Hardware Details Added Successfully');
    }

    public function edit(Hardware $hardware)
    {
        $companies = Company::all();
        return view('employee.edit_hardware', compact('hardware', 'companies'));
    }

    public function update(UpdateHardwareRequest $request, Hardware $hardware)
    {
        $hardware->update($request->validated());
        return redirect()
               ->route('employee.hardwares.index')
               ->with('success', 'Hardware Details Updated Successfully');
    }


    public function destroy(Hardware $hardware)
    {
        $hardware->delete();
        return redirect()
               ->route('employee.hardwares.index')
               ->with('success', 'Hardware Details Deleted Successfully');
    }
    
}
