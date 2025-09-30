<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Details') }}
        </h2>
    </x-slot>

    <div class="mx-5 my-5">

        {{-- Flash success message --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Add company button --}}
        <div class="mb-4 flex justify-end max-w-[80%] mx-auto">
            <a href="{{ route('employee.company-details.create') }}"
               class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-md shadow transition">
                + Add Company
            </a>
        </div>

        {{-- Desktop table --}}
        <div class="hidden md:block overflow-x-auto max-w-[80%] mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <table class="hidden md:table min-w-full border bg-white border-gray-200">
                <thead class="bg-orange-100">
                    <tr>
                        <th class="px-4 py-2 text-left border">Name</th>
                        <th class="px-4 py-2 text-left border">Phone Number</th>
                        <th class="px-4 py-2 text-left border">Location</th>
                        <th class="px-4 py-2 text-left border">Assigned Employee</th>
                        <th class="px-4 py-2 text-left border">Backup Employee</th>
                        <th class="px-4 py-2 text-left border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">
                                <a href="{{ route('employee.company-details.show', $company) }}">
                                    {{ $company->name }}
                                </a>
                            </td>
                            <td class="px-4 py-2 border">{{ $company->phone_number }}</td>
                            <td class="px-4 py-2 border">
                                <a href="{{ $company->link }}" target="_blank" rel="noopener noreferrer">
                                    {{ $company->location }}
                                </a>
                            </td>
                            <td class="px-4 py-2 border">{{ $company->employee }}</td>
                            <td class="px-4 py-2 border">{{ $company->backup_employee }}</td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('employee.company-details.edit', $company) }}"
                                   class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-2 py-1 rounded-md shadow transition">
                                    Edit
                                </a>
                                <form 
                                action="{{ route('employee.company-details.destroy', $company) }}" 
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this software?');"
                                class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold px-2 py-1 rounded-md shadow transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                No company records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $companies->links() }}
            </div>
        </div>

        {{-- Mobile stacked cards --}}
        <div class="md:hidden space-y-4 mt-6">
            @forelse($companies as $company)
                <div class="border rounded-lg p-4 bg-white shadow">
                    
                    <div>
                        <a href="{{ route('employee.company-details.show', $company) }}">
                            <span class="font-semibold">Name:</span> {{ $company->name }}
                        </a>
                    </div>
                    <div><span class="font-semibold">Phone:</span> {{ $company->phone_number }}</div>
                    <div><span class="font-semibold">Location:</span> {{ $company->location }}</div>
                    <div><span class="font-semibold">Assigned Employee:</span> {{ $company->employee }}</div>
                    <div><span class="font-semibold">Backup Employee:</span> {{ $company->backup_employee }}</div>
                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('employee.company-details.edit', $company) }}"
                          class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-2 py-1 rounded-md shadow transition">
                                Edit
                        </a>
                        <form 
                        action="{{ route('employee.company-details.destroy', $company) }}" 
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this software?');"
                        class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold px-2 py-1 rounded-md shadow transition">
                                Delete
                            </button>
                        </form>
                    
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No company records found.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
