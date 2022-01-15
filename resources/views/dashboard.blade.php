<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __('You\'re logged in!') }}
                </div>
                <div class="d-flex flex-column">
                    <h1><a class="btn btn-success" href="{{ route('students.index') }}">資料庫CRUD範例</a></h1>
                    <h1><a class="btn btn-info" href="{{ route('cars.index') }}">範例2</a></h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
