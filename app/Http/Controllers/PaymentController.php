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

        // Get all visits for the current week
        $visits = CompanyVisit::with('company', 'payments')
            ->where('user_id', $user->id)
            ->whereBetween('visit_date', [$startOfWeek, $endOfWeek])
            ->get()
            ->map(function ($visit) use ($user) {
                $visit->existing_payment = $visit->payments
                    ->where('user_id', $user->id)
                    ->first();
                return $visit;
            });

        return view('employee.payment_details', compact('visits'));
    }

    public function store(Request $request)
{
    $userId = Auth::id();

    // Ensure visit_id exists and is array
    if ($request->has('visit_id') && is_array($request->visit_id)) {
        foreach ($request->visit_id as $key => $visitId) {

            // Only save if amount is provided
            $amount = $request->amount[$key] ?? null;

            if ($amount !== null && $amount !== '') {
                Payment::updateOrCreate(
                    ['visit_id' => $visitId, 'user_id' => $userId], // unique key
                    [
                        'company_id' => $request->company_id[$key],
                        'date' => $request->date[$key],
                        'amount' => $amount,
                        'description' => $request->description[$key] ?? null,
                    ]
                );
            }
        }
    }

    return redirect()->back()->with('success', 'Payments saved successfully!');
}




}
