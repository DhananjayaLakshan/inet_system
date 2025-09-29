<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Company;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('company','user')->latest()->paginate(10);
        return view('employee.payment_details', compact('payments'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('employee.add_payments', compact('companies'));
    }

    public function store(StorePaymentRequest $request)
    {
        Payment::create($request->validated());
        return redirect()
               ->route('employee.payments.index')
               ->with('success','Payment added successfully');
    }

    public function edit(Payment $payment)
    {
        $companies = Company::all();
        return view('employee.edit_payments', compact('payment', 'companies'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());
        return redirect()
               ->route('employee.payments.index')
               ->with('success','Payment updated successfully');
    }

    public function destroy(Payment $payment)
    {}
}
