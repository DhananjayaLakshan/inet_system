<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateSoftwareRequest;
use App\Models\Software;
use Illuminate\Http\Request;

class SoftwareController extends Controller
{
    public function index ()
    {
        $softwares = Software::latest()->paginate(10);
        return view('employee.software_details', compact('softwares'));
    }

    public function create()
    {}

    public function store (StoreServiceRequest $request)
    {}

    public function show()
    {}

    public function edit(Software $software)
    {}

    public function update (UpdateSoftwareRequest $request, Software $software)
    {}

    public function destroy (Software $software)
    {}
}
