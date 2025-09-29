<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Company Details') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('employee.company-details.store') }}"
          class="mt-10 mb-5 max-w-sm mx-auto bg-white p-4 rounded-md shadow-lg">
        @csrf

        <div class="mb-5 mx-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Company Name</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name') }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                   required>
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5 mx-5">
            <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number"
                   value="{{ old('phone_number') }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                   required>
            @error('phone_number') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5 mx-5">
            <label for="location" class="block mb-2 text-sm font-medium text-gray-900">Location</label>
            <input type="text" name="location" id="location"
                   value="{{ old('location') }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                   required>
            @error('location') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        
        <div class="mb-5 mx-5">
            <label for="link" class="block mb-2 text-sm font-medium text-gray-900">Location link</label>
            <input type="text" name="link" id="link"
                   value="{{ old('link') }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                   required>
            @error('link') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5 mx-5">
            <label for="employee" class="block mb-2 text-sm font-medium text-gray-900">Assigned Employee</label>
            <input type="text" name="employee" id="employee"
                   value="{{ old('employee') }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                   required>
            @error('employee') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5 mx-5">
            <label for="backup_employee" class="block mb-2 text-sm font-medium text-gray-900">Backup Employee</label>
            <input type="text" name="backup_employee" id="backup_employee"
                   value="{{ old('backup_employee') }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5">
            @error('backup_employee') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5 mx-5">
            <button type="submit"
                    class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                Submit
            </button>
        </div>
    </form>
</x-app-layout>
