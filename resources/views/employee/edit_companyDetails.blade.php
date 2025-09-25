<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Company Details') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('employee.company-details.update',  $company) }}"
          class="mt-10 mb-5 max-w-sm mx-auto bg-white p-4 rounded-md shadow-lg">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium">Company Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}"
                   class="w-full px-3 py-2 border rounded focus:ring focus:ring-orange-200">
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="phone_number" class="block mb-2 text-sm font-medium">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number"
                   value="{{ old('phone_number', $company->phone_number) }}"
                   class="w-full px-3 py-2 border rounded focus:ring focus:ring-orange-200">
            @error('phone_number') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="location" class="block mb-2 text-sm font-medium">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location', $company->location) }}"
                   class="w-full px-3 py-2 border rounded focus:ring focus:ring-orange-200">
            @error('location') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="employee" class="block mb-2 text-sm font-medium">Assigned Employee</label>
            <input type="text" name="employee" id="employee" value="{{ old('employee', $company->employee) }}"
                   class="w-full px-3 py-2 border rounded focus:ring focus:ring-orange-200">
            @error('employee') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5">
            <label for="backup_employee" class="block mb-2 text-sm font-medium">Backup Employee</label>
            <input type="text" name="backup_employee" id="backup_employee"
                   value="{{ old('backup_employee', $company->backup_employee) }}"
                   class="w-full px-3 py-2 border rounded focus:ring focus:ring-orange-200">
            @error('backup_employee') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-4 py-2 rounded">
            Update Company
        </button>
    </form>
</x-app-layout>
