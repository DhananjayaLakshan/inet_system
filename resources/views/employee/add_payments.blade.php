<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Payment Details') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('employee.payments.store') }}"
          class="mt-10 mb-5 max-w-sm mx-auto bg-white p-4 rounded-md shadow-lg">
        @csrf

        <div class="mb-5 mx-5">
            <label for="company_id" class="block mb-2 text-sm font-medium text-gray-900">Company</label>
            <select name="company_id" id="company_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                    required>
                <option value="">-- Select a Company --</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            @error('company_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5 mx-5">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <label for="employee_name" class="block mb-2 text-sm font-medium text-gray-900">Employee</label>
            <input type="text" name="employee_name" id="employee_name"
                   value="{{ Auth::user()->name }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                   disabled>
            @error('user_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5 mx-5">
            <label for="installed_date" class="block mb-2 text-sm font-medium text-gray-900">Date</label>
            <input type="date" name="date" id="date"
                   value="{{ old('date', date('Y-m-d')) }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                   required>
            @error('date') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="relative mb-5 mx-5">
            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">Amount</label>
            <input type="number" min="0" step="0.01" name="amount" id="amount"
                value="{{ old('amount') }}"
                class="pl-7 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                required>
            @error('amount') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5 mx-5">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
            <textarea 
                name="description" 
                id="description" 
                rows="6"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
            >{{ old('description') }}</textarea>
            @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5 mx-5">
            <button type="submit"
                    class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                Submit
            </button>
        </div>
    </form>
</x-app-layout>
