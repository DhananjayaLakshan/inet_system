<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Company;
use App\Models\CompanyVisit;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Fetch all visits for the current week
        $visits = CompanyVisit::with('company')
            ->where('user_id', $user->id)
            ->whereBetween('visit_date', [$startOfWeek, $endOfWeek])
            ->get()
            ->map(function ($visit) use ($user) {
                // Fetch payment if exists
                $payment = Payment::where('user_id', $user->id)
                    ->where('company_id', $visit->company_id)
                    ->where('date', $visit->visit_date)
                    ->first();

                // Mark visit as editable if payment exists or new payment can be created
                $visit->existing_payment = $payment;
                $visit->is_editable = true; // optional flag if you want to disable old records later
                return $visit;
            });

        return view('employee.payment_details', compact('visits'));
    }



    public function store(Request $request)
    {
        foreach ($request->user_id as $visitId => $userId) {

            // Check if a payment already exists for this visit
            $payment = Payment::where('user_id', $userId)
                ->where('company_id', $request->company_id[$visitId])
                ->where('date', $request->date[$visitId])
                ->first();

            if ($payment) {
                // Update existing payment
                $payment->update([
                    'amount' => $request->amount[$visitId],
                    'description' => $request->description[$visitId] ?? null,
                ]);
            } else {
                // Only create new payment if amount is provided
                if (!empty($request->amount[$visitId])) {
                    Payment::create([
                        'user_id' => $userId,
                        'company_id' => $request->company_id[$visitId],
                        'date' => $request->date[$visitId],
                        'amount' => $request->amount[$visitId],
                        'description' => $request->description[$visitId] ?? null,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Payments saved successfully!');
    }



}
