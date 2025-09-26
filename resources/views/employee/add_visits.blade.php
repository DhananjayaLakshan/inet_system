<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Company Visit') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('employee.visits.store') }}"
          class="mt-10 mb-5 max-w-lg mx-auto bg-white p-6 rounded-md shadow-lg">
        @csrf

        {{-- Company --}}
        <div class="mb-5">
            <label for="company_id" class="block mb-2 text-sm font-medium">Company</label>
            <select name="company_id" id="company_id"
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-orange-200">
                <option value="">-- Select a Company --</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            @error('company_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Employee --}}
        <div class="mb-5">
            <label for="user_id" class="block mb-2 text-sm font-medium">Employee</label>
            <select name="user_id" id="user_id"
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-orange-200">
                <option value="">-- Select Employee --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('user_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Visit Date --}}
        <div class="mb-5">
            <label for="visit_date" class="block mb-2 text-sm font-medium">Visit Date</label>
            <input type="date" name="visit_date" id="visit_date" value="{{ old('visit_date') }}"
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-orange-200">
            @error('visit_date') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Visit Time --}}
        <div class="mb-5">
            <label for="visit_time" class="block mb-2 text-sm font-medium">Visit Time</label>
            <input type="time" name="visit_time" id="visit_time" value="{{ old('visit_time') }}"
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-orange-200">
            @error('visit_time') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Leave Time --}}
        <div class="mb-5">
            <label for="leave_time" class="block mb-2 text-sm font-medium">Leave Time</label>
            <input type="time" name="leave_time" id="leave_time" value="{{ old('leave_time') }}"
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-orange-200">
            @error('leave_time') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Work Done --}}
        <div class="mb-5">
            <label for="work_done" class="block mb-2 text-sm font-medium">Work Done</label>
            <textarea name="work_done" id="work_done" rows="4"
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-orange-200">{{ old('work_done') }}</textarea>
            @error('work_done') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
            class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded font-semibold">
            Save Visit
        </button>
    </form>
</x-app-layout>
