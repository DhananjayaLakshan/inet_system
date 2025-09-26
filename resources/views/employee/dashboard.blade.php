<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Visits') }}
        </h2>
    </x-slot>

    <div class="mx-5 my-5" x-data="{ tab: 'weekly' }">

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabs --}}
        <div class="mb-6 border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <button 
                    @click="tab = 'weekly'" 
                    :class="tab === 'weekly' 
                        ? 'border-orange-500 text-orange-600' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap pb-2 px-1 border-b-2 font-medium text-sm">
                    Weekly Report
                </button>

                <button 
                    @click="tab = 'visits'" 
                    :class="tab === 'visits' 
                        ? 'border-orange-500 text-orange-600' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap pb-2 px-1 border-b-2 font-medium text-sm">
                    All Visits
                </button>
            </nav>
        </div>

        {{-- Weekly Report Tab --}}
        <div x-show="tab === 'weekly'" class="mt-6">
            <div class="md:mx-auto bg-white p-4 rounded shadow md:max-w-[80%]">

                {{-- Week selector --}}
                <form method="GET" action="{{ route('employee.dashboard') }}" class="mb-4 flex flex-col md:flex-row md:items-center gap-3">
                    <label for="week" class="font-medium">Select Week:</label>
                    <select name="week" id="week" class="border rounded px-2 py-1">
                        <option value="{{ now()->format('o-\WW') }}" {{ $selectedWeek == now()->format('o-\WW') ? 'selected' : '' }}>
                            This Week ({{ now()->startOfWeek()->format('M d') }} - {{ now()->endOfWeek()->format('M d') }})
                        </option>
                        <option value="{{ now()->subWeek()->format('o-\WW') }}" {{ $selectedWeek == now()->subWeek()->format('o-\WW') ? 'selected' : '' }}>
                            Last Week ({{ now()->subWeek()->startOfWeek()->format('M d') }} - {{ now()->subWeek()->endOfWeek()->format('M d') }})
                        </option>
                        <option value="{{ now()->subWeeks(2)->format('o-\WW') }}" {{ $selectedWeek == now()->subWeeks(2)->format('o-\WW') ? 'selected' : '' }}>
                            2 Weeks Ago ({{ now()->subWeeks(2)->startOfWeek()->format('M d') }} - {{ now()->subWeeks(2)->endOfWeek()->format('M d') }})
                        </option>
                        <option value="{{ now()->subWeeks(3)->format('o-\WW') }}" {{ $selectedWeek == now()->subWeeks(3)->format('o-\WW') ? 'selected' : '' }}>
                            3 Weeks Ago ({{ now()->subWeeks(3)->startOfWeek()->format('M d') }} - {{ now()->subWeeks(3)->endOfWeek()->format('M d') }})
                        </option>
                    </select>
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded">
                        Filter
                    </button>
                </form>

                {{-- Add Visit button --}}
                <div class="flex justify-start md:justify-end mb-4">
                    <a href="{{ route('employee.visits.create') }}"
                       class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-md shadow transition">
                        + Add Visit
                    </a>
                </div>

                {{-- Companies NOT visited --}}
                <div class="mt-6 bg-red-50 mb-10 p-4 rounded shadow">
                    <h3 class="text-lg font-semibold text-red-600 mb-3">Companies Not Visited This Week</h3>
                    @forelse($companiesNotVisited as $company)
                        <p class="text-gray-800">- {{ $company->name }}</p>
                    @empty
                        <p class="text-gray-500">All companies have been visited this week 🎉</p>
                    @endforelse
                </div>

                {{-- Weekly visits grouped --}}
                @forelse($weeklyVisits as $companyId => $visitsForCompany)
                    <div class="mb-4 border-b pb-3">
                        <h4 class="font-bold text-orange-600">{{ $visitsForCompany->first()->company->name }}</h4>
                        <p>Total Visits: <strong>{{ $visitsForCompany->count() }}</strong></p>
                        <ul class="list-disc list-inside text-gray-700">
                            @foreach($visitsForCompany as $visit)
                                <li>
                                    <span class="font-semibold">{{ $visit->user->name }}</span>
                                    visited on {{ $visit->visit_date }}
                                    ({{ $visit->visit_time }} → {{ $visit->leave_time }})
                                    → Work: {{ $visit->work_done }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <p class="text-gray-500">No visits recorded this week.</p>
                @endforelse
            </div>
        </div>

        {{-- All Visits Tab --}}
        <div x-show="tab === 'visits'" class="mt-6">
            {{-- Desktop table --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full border bg-white border-gray-200">
                    <thead class="bg-orange-100">
                        <tr>
                            <th class="px-4 py-2 text-left border">Company</th>
                            <th class="px-4 py-2 text-left border">Employee</th>
                            <th class="px-4 py-2 text-left border">Visit Date</th>
                            <th class="px-4 py-2 text-left border">Work Done</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visits as $visit)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $visit->company->name }}</td>
                                <td class="px-4 py-2 border">{{ $visit->user->name }}</td>
                                <td class="px-4 py-2 border">{{ $visit->visit_date }}</td>
                                <td class="px-4 py-2 border">{{ $visit->work_done }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                    No visits found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile cards --}}
            <div class="md:hidden space-y-4">
                @forelse($visits as $visit)
                    <div class="bg-white p-4 rounded shadow-md">
                        <p class="text-orange-500 text-lg font-bold">{{ $visit->company->name }}</p>
                        <p><strong>Employee:</strong> {{ $visit->user->name }}</p>
                        <p><strong>Date:</strong> {{ $visit->visit_date }}</p>
                        <p><strong>Work:</strong> {{ $visit->work_done }}</p>
                    </div>
                @empty
                    <p class="text-gray-500 text-center">No visits found.</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $visits->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
