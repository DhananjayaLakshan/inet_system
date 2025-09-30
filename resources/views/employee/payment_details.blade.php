<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ ('Weekly Payments') }}
        </h2>
    </x-slot>

    <div class="py-6 hidden md:block ">
        <div class="sm:px-6 lg:px-8 bg-white p-6 rounded shadow max-w-[80%] mx-auto">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-2xl font-semibold text-orange-500 mb-3">{{ Auth::user()->name }}'s weekly payments</h1>

            <form action="{{ route('employee.payments.store') }}" method="POST">
                @csrf
                <table class="min-w-full  border border-gray-300">
                    <thead class="bg-orange-100">
                        <tr>
                            <th class="border px-4 py-2">Company</th>
                            <th class="border px-4 py-2">Visit Date</th>
                            <th class="border px-4 py-2">Visit Time</th>
                            <th class="border px-4 py-2">Leave Time</th>
                            <th class="border px-4 py-2">Work Done</th>
                            <th class="border px-4 py-2">Amount</th>
                            <th class="border px-4 py-2">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visits as $visit)
                            <tr>
                                <td class="border px-4 py-2">{{ $visit->company->name }}</td>
                                <td class="border px-4 py-2">{{ $visit->visit_date }}</td>
                                <td class="border px-4 py-2">{{ $visit->visit_time }}</td>
                                <td class="border px-4 py-2">{{ $visit->leave_time }}</td>
                                <td class="border px-4 py-2">{{ $visit->work_done }}</td>

                                <td class="border px-4 py-2">
                                    <input type="number" step="0.01" name="amount[{{ $visit->id }}]" 
                                        value="{{ $visit->existing_payment->amount ?? '' }}" 
                                        class="border rounded px-2 py-1" 
                                        {{ isset($visit->existing_payment) ? '' : 'placeholder= Amount' }} 
                                        required>
                                </td>

                                <td class="border px-4 py-2">
                                    <textarea name="description[{{ $visit->id }}]" 
                                            class="border rounded px-2 py-1 w-full" rows="3"
                                            placeholder="Enter description">{{ $visit->existing_payment->description ?? '' }}</textarea>
                                </td>

                                <!-- Hidden fields -->
                                <input type="hidden" name="user_id[{{ $visit->id }}]" value="{{ auth()->id() }}">
                                <input type="hidden" name="company_id[{{ $visit->id }}]" value="{{ $visit->company_id }}">
                                <input type="hidden" name="date[{{ $visit->id }}]" value="{{ $visit->visit_date }}">
                                <input type="hidden" name="visit_id[{{ $visit->id }}]" value="{{ $visit->id }}">
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4 flex justify-end">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                        Save Payments
                    </button>
                </div>
            </form>

        </div>
    </div>    

{{-- Mobile view --}}

<div class="py-6 md:hidden">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8 space-y-4">
            
            @if(session('success'))
                <div class="p-4 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-xl font-semibold text-orange-500 mb-3 text-center">{{ Auth::user()->name }}'s weekly payments</h1>

            <form action="{{ route('employee.payments.store') }}" method="POST" class="space-y-4">
                @csrf
                @foreach($visits as $visit)
                    <div class="bg-white p-4 rounded shadow space-y-2">
                        <h3 class="font-semibold text-lg">{{ $visit->company->name }}</h3>
                        <p><span class="font-medium">Visit Date:</span> {{ $visit->visit_date }}</p>
                        <p><span class="font-medium">Visit Time:</span> {{ $visit->visit_time }}</p>
                        <p><span class="font-medium">Leave Time:</span> {{ $visit->leave_time }}</p>
                        <p><span class="font-medium">Work Done:</span> {{ $visit->work_done }}</p>

                        <div>
                            <label class="block font-medium">Amount</label>
                            <input type="number" step="0.01" name="amount[{{ $visit->id }}]" 
                                value="{{ $visit->existing_payment->amount ?? '' }}" 
                                class="w-full border rounded px-2 py-1" required>
                        </div>

                        <div>
                            <label class="block font-medium">Description</label>
                            <textarea name="description[{{ $visit->id }}]" 
                                    class="border rounded px-2 py-1 w-full" rows="3"
                                    placeholder="Enter description">{{ $visit->existing_payment->description ?? '' }}</textarea>
                        </div>

                        <!-- Hidden fields -->
                        <input type="hidden" name="user_id[{{ $visit->id }}]" value="{{ auth()->id() }}">
                        <input type="hidden" name="company_id[{{ $visit->id }}]" value="{{ $visit->company_id }}">
                        <input type="hidden" name="date[{{ $visit->id }}]" value="{{ $visit->visit_date }}">
                        <input type="hidden" name="visit_id[{{ $visit->id }}]" value="{{ $visit->id }}">
                    </div>
                @endforeach

                <div class="mt-4">
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                        Save Payments
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>




