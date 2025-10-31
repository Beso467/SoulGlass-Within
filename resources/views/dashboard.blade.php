<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Optional welcome panel -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>

            <!-- Mirrors Table -->
            <div class="mt-6">
                <livewire:mirror />
            </div>

            <!-- Mirror Form Modal -->
            <livewire:mirror-form />
        </div>
    </div>
</x-app-layout>
