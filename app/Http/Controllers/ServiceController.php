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

    public function create(){}

    public function store(StoreServiceRequest $request) {}

    public function edit(Service $service){}

    public function update(UpdateCompanyRequest $request, Service $service){}

    public function destroy(Service $service){}


}
