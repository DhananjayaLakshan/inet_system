<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }} - Profile
        </h2>
    </x-slot>

    <div class="mt-6 p-6 md:w-[80%] mx-auto bg-white rounded-md shadow-md">
        {{-- Company Basic Info --}}
        <h3 class="text-lg md:text-2xl font-bold text-orange-500 mb-3">Company Info</h3>
        <ul class="mb-4">
            <li><strong>Phone:</strong> {{ $company->phone_number }}</li>

            <a href="{{ $company->link }}" target="_blank">
                <li><strong>Location:</strong> {{ $company->location }}</li>
            </a>

            <li><strong>Employee:</strong> {{ $company->employee }}</li>
            <li><strong>Backup Employee:</strong> {{ $company->backup_employee }}</li>
        </ul>

        <hr class="my-4">

        {{-- Desktop Service View --}}
        <h3 class="text-2xl md:text-lg font-bold mt-6 text-orange-500 bg-orange-50 p-2">Services</h3>
        <table class="hidden md:block table-auto w-full ">
            <thead>
                <tr>
                    <th class="border px-2 py-1 w-[15%]">Service Date</th>
                    <th class="border px-2 py-1 w-[15%]">Next Service Date</th>
                    <th class="border px-2 py-1">Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse($company->services as $service)
                    <tr>
                        <td class="border px-2 py-1">{{ $service->service_date }}</td>
                        <td class="border px-2 py-1">{{ $service->next_service_date }}</td>
                        <td class="border px-2 py-1">{{ $service->description }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center">No services found</td></tr>
                @endforelse
            </tbody>
        </table>

        {{-- Mobile Service View --}}
        <div class="md:hidden my-4">
            @foreach ($company->services as $service)
                <div class="border-b border-orange-600 mt-3 p-2">
                    <p><strong>Service Date:</strong></p>
                    <p class="mb-2"> {{ $service->service_date }}</p>
                    <p><strong>Next Service Date:</strong></p>
                    <p class="mb-2">{{ $service->next_service_date }}</p>
                    <p><strong>Description:</strong></p>
                    <p class="text-justify">{{ $service->description }}</p>
                </div>
            @endforeach
        </div>

        {{-- Desktop Softwares View --}}
        <h3 class="text-2xl md:text-lg font-bold mt-6 text-orange-500 bg-orange-50 p-2">Softwares</h3>
        <table class="hidden md:block table-auto w-full">
            <thead>
                <tr>
                    <th class="border px-2 py-1 w-[20%]">User</th>
                    <th class="border px-2 py-1 w-[10%]">Installed Date</th>
                    <th class="border px-2 py-1 w-[10%]">Expiration Date</th>
                    <th class="border px-2 py-1 w-[20%]">License Key</th>
                    <th class="border px-2 py-1 w-[50%]">Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse($company->softwares as $software)
                    <tr>
                        <td class="border px-2 py-1">{{ $software->user }}</td>
                        <td class="border px-2 py-1">{{ $software->installed_date }}</td>
                        <td class="border px-2 py-1">{{ $software->expiration_date }}</td>
                        <td class="border px-2 py-1">{{ $software->license_key }}</td>
                        <td class="border px-2 py-1">{{ $software->description }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No softwares found</td></tr>
                @endforelse
            </tbody>
        </table>
        
        {{-- Mobile Softwares View --}}
        <div class="md:hidden my-4">
            @foreach ($company->softwares as $software)
                <div class="border-b border-orange-600 mt-3 p-2">
                    <p><strong>User Name:</strong></p>
                    <p class="mb-2"> {{ $software->user }}</p>
                    <p><strong>Installed Date:</strong></p>
                    <p class="mb-2">{{ $software->installed_date }}</p>
                    <p><strong>Expiration Date:</strong></p>
                    <p class="mb-2">{{ $software->expiration_date }}</p>
                    <p><strong>License key:</strong></p>
                    <p class="text-justify mb-2">{{ $software->license_key }}</p>
                    <p><strong>Description:</strong></p>
                    <p class="text-justify mb-2">{{ $software->description }}</p>
                </div>
            @endforeach
        </div>

        {{-- Desktop Hardwares & Items View --}}
        <h3 class="text-2xl md:text-lg font-bold mt-6 text-orange-500 bg-orange-50 p-2">Hardwares & Items</h3>
        <table class="hidden md:block table-auto w-full">
            <thead>
                <tr>
                    <th class="border px-2 py-1 w-[15%]">User</th>
                    <th class="border px-2 py-1 w-[5%]">Date</th>
                    <th class="border px-2 py-1 w-[10%]">Warranty</th>
                    <th class="border px-2 py-1 w-[10%]">Brand</th>
                    <th class="border px-2 py-1 w-[30%]">Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse($company->hardwares as $hardware)
                    <tr>
                        <td class="border px-2 py-1">{{ $hardware->user }}</td>
                        <td class="border px-2 py-1">{{ $hardware->date }}</td>
                        <td class="border px-2 py-1">{{ $hardware->warranty }}</td>
                        <td class="border px-2 py-1">{{ $hardware->brand }}</td>
                        <td class="border px-2 py-1">{{ $hardware->description }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No hardwares found</td></tr>
                @endforelse
            </tbody>
        </table>

         {{-- Mobile Hardwares & Items View --}}
        <div class="md:hidden my-4">
            @foreach ($company->hardwares as $hardware)
                <div class="border-b border-orange-600 mt-3 p-2">
                    <p><strong>User Name:</strong></p>
                    <p class="mb-2"> {{ $hardware->user }}</p>
                    <p><strong>Date:</strong></p>
                    <p class="mb-2">{{ $hardware->date }}</p>
                    <p><strong>Warranty:</strong></p>
                    <p class="mb-2">{{ $hardware->warranty }}</p>
                    <p><strong>Brand:</strong></p>
                    <p class="text-justify mb-2">{{ $hardware->brand }}</p>
                    <p><strong>Description:</strong></p>
                    <p class="text-justify mb-2">{{ $hardware->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
