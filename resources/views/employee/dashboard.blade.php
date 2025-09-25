<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6 ">
        <p class="text-xl text-center md:text-left md:text-3xl">
            Welcome, {{ Auth::user()->name }} !!
        </p>

    </div>
</x-app-layout>
