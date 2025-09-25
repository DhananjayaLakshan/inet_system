<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Software Details') }}
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
            <a href="{{ route('employee.softwares.create') }}"
               class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-md shadow transition">
                + Add Software
            </a>
        </div>

        {{-- Desktop table --}}
        <div class="overflow-x-auto">
            <table class="hidden md:table min-w-full border bg-white border-gray-200">
                <thead class="bg-orange-100">
                    <tr>
                        <th class="px-4 py-2 text-left border">Name</th>
                        <th class="px-4 py-2 text-left border">User</th>
                        <th class="px-4 py-2 text-left border">Installed Date</th>
                        <th class="px-4 py-2 text-left border">Expiration Date</th>
                        <th class="px-4 py-2 text-left border">License Key</th>
                        <th class="px-4 py-2 text-left w-[30rem] border">Descriptioin</th>
                        <th class="px-4 py-2 text-left border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($softwares as $software)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $software->company->name }}</td>
                            <td class="px-4 py-2 border">{{ $software->user }}</td>
                            <td class="px-4 py-2 border">{{ $software->installed_date }}</td>
                            <td class="px-4 py-2 border">{{ $software->expiration_date }}</td>
                            <td class="px-4 py-2 border">{{ $software->license_key }}</td>
                            <td class="px-4 py-2 border text-justify">{{ $software->description }}</td>
                            <td class="px-4 py-2 border">
                                <a href="{{ route('employee.softwares.edit', $software) }}"
                                   class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-2 py-1 rounded-md shadow transition">
                                    Edit
                                </a>
                                <form 
                                action="{{ route('employee.softwares.destroy', $software) }}" 
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
                                No software records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $softwares->links() }}
            </div>
        </div>

        {{-- Mobile stacked cards --}}
        <div class="md:hidden space-y-4 mt-6">
            @forelse($softwares as $software)
                <div class="border rounded-lg p-4 bg-white shadow">
                    <div><p class="text-lg font-semibold text-center text-orange-500 my-5">{{ $software->company->name }}</p> </div>
                    <div><span class="font-semibold">User:</span> {{ $software->user }}</div>
                    <div><span class="font-semibold">Installed Date:</span> {{ $software->installed_date }}</div>
                    <div><span class="font-semibold">Expiration Date:</span> {{ $software->expiration_date }}</div>
                    
                    <div class="my-2">
                        <div><span class="font-semibold">License Key:</span></div>
                        <div>{{ $software->license_key }}</div>
                    </div>

                    <div class="my-2">
                        <div><span class="font-semibold">Description:</span> </div>
                        <div> {{ $software->description }}</div>
                    </div>
                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('employee.softwares.edit', $software) }}"
                          class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold px-2 py-1 rounded-md shadow transition">
                                Edit
                        </a>
                        <form 
                        action="{{ route('employee.softwares.destroy', $software) }}" 
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
