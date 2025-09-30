<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Service Details') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('employee.services.update', $service) }}"
          class="mt-10 mb-5 max-w-sm mx-auto bg-white p-4 rounded-md shadow-lg">
        @csrf
        @method('PUT')

        <div class="mb-5 mx-5">
            <label for="company_id" class="block mb-2 text-sm font-medium text-gray-900">Company</label>
            <select name="company_id" id="company_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                    required>
                <option value="">-- Select a Company --</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id', $service->company_id) == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            @error('company_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5 mx-5">
            <label for="service_date" class="block mb-2 text-sm font-medium text-gray-900">Service Date</label>
            <input type="date" name="service_date" id="service_date"
                   value="{{ old('service_date',$service->service_date) }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                   required>
            @error('service_date') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5 mx-5">
            <label for="next_service_date" class="block mb-2 text-sm font-medium text-gray-900">Next Service Date</label>
            <input type="date" name="next_service_date" id="next_service_date"
                   value="{{ old('next_service_date',$service->next_service_date) }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
                   required>
            @error('next_service_date') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-5 mx-5">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
            <textarea 
            name="description" 
            id="description" 
            rows="6"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5"
            >
                {{ old('description', $service->description) }}
            </textarea>
            @error('description') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>


        <div class="mb-5 mx-5">
            <button type="submit"
                    class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                Update Service
            </button>
        </div>
    </form>
</x-app-layout>
