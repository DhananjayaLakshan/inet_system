<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view("employee.service_details", compact("services"));
    }

    public function create()
    {
        return view('employee.add_services');
    }

    public function store(StoreServiceRequest $request) 
    {
        Service::create($request->validated());

        return redirect()
        ->route('employee.services.index')
        ->with('success','Service added successfully');
    }

    public function edit(Service $service){}

    public function update(UpdateCompanyRequest $request, Service $service){}

    public function destroy(Service $service){}


}
