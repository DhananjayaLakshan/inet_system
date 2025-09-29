<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitRequest;
use App\Http\Requests\UpdateVisitRequest;
use App\Models\Company;
use App\Models\CompanyVisit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        // Get selected week or default to current week
        $selectedWeek = $request->input('week', now()->format('o-\WW')); // ISO week format

        // Parse start & end of the selected week
        [$year, $week] = explode('-W', $selectedWeek);
        $startOfWeek = Carbon::now()->setISODate($year, $week)->startOfWeek();
        $endOfWeek   = Carbon::now()->setISODate($year, $week)->endOfWeek();

        // Visits for that week
        $weeklyVisits = CompanyVisit::with(['company', 'user'])
            ->whereBetween('visit_date', [$startOfWeek, $endOfWeek])
            ->get()
            ->groupBy('company_id');

        // Visits list (all, for bottom table)
        $visits = CompanyVisit::with(['company', 'user'])
            ->latest()
            ->paginate(10);

        // Companies that had no visits this week
        $companiesNotVisited = Company::whereDoesntHave('visits', function ($q) use ($startOfWeek, $endOfWeek) {
            $q->whereBetween('visit_date', [$startOfWeek, $endOfWeek]);
        })->get();

        return view('employee.dashboard', compact(
            'visits', 
            'weeklyVisits', 
            'companiesNotVisited',
            'selectedWeek',
            'startOfWeek', 
            'endOfWeek'
        ));
    }


    public function create()
    {
        $companies = Company::orderBy('name')->get();
        $employees = User::where('role', 'employee')->orderBy('name')->get();

        return view('employee.add_visits', compact('companies', 'employees'));
    }

    public function store(StoreVisitRequest $request)
    {
        CompanyVisit::create($request->validated());

        return redirect()->route('employee.visits.index')->with('success','Visit added successfully');
    }

    public function edit(CompanyVisit $visit)
    {

        $companies = Company::all();
        $employees = User::where('role', 'employee')->get();

        return view('employee.edit_visits', compact('visit', 'companies', 'employees'));

    }

    public function update(UpdateVisitRequest $request, CompanyVisit $visit)
    {
        $visit->update($request->validated());

        return redirect()
            ->route('employee.visits.index')
            ->with('success', 'Visit record updated successfully.');
    }

    public function destroy(CompanyVisit $visit)
    {
        $visit->delete();

        return redirect()
            ->route('employee.visits.index')
            ->with('success', 'Visit record deleted successfully.');
    }
    
}
