<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service Details') }}
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
        <div class="mb-4">
            <a href="{{ route('employee.services.create') }}"
               class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-md shadow transition">
                + Add Service
            </a>
        </div>

        {{-- Desktop table --}}
        <div class="overflow-x-auto">
            <table class="hidden md:table min-w-full border bg-white border-gray-200">
                <thead class="bg-orange-100">
                    <tr>
                        <th class="px-4 py-2 text-left border">Name</th>
                        <th class="px-4 py-2 text-left border">Serviced Date</th>
                        <th class="px-4 py-2 text-left border w-[45rem]">Description</th>
                        <th class="px-4 py-2 text-left border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $service->name }}</td>
                            <td class="px-4 py-2 border">{{ $service->service_date }}</td>
                            <td class="px-4 py-2 border">{{ $service->description }}</td>
                            
                            <td class="px-4 py-2 border">
                                <a href="{{ route('employee.services.edit', $service) }}"
                                   class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-2 py-1 rounded-md shadow transition">
                                    Edit
                                </a>
                                <form 
                                action="{{ route('employee.services.destroy', $service) }}" 
                                method="POST"
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
                {{ $services->links() }}
            </div>
        </div>

        {{-- Mobile stacked cards --}}
        <div class="md:hidden space-y-4 mt-6">
            @forelse($services as $service)
                <div class="border rounded-lg p-4 bg-white shadow">
                    <div><span class="font-semibold">Name:</span> {{ $service->name }}</div>
                    <div><span class="font-semibold">Service Date:</span> {{ $service->service_date }}</div>
                    <div><span class="font-semibold">Description:</span> </div>
                    <div><span class="font-semibold"> {{ $service->description }}</div>
                    
                    <div class="mt-4 flex justify-between">
                        <a 
                            href="{{ route('employee.services.edit', $service) }}"
                          class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-2 py-1 rounded-md shadow transition">
                                Edit
                        </a>
                        <form 
                        action="{{ route('employee.services.destroy', $service) }}" 
                        method="POST"
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
