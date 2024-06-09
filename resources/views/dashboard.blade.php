<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-8">
                <div class="overflow-hidden shadow-sm rounded-lg">
                    <div class="py-6 text-white text-4xl">
                        Welcome back {{ auth()->user()->name }}
                    </div>
                    <div class="text-xl pb-6">
                        Login sebagai {{ auth()->user()->email }}
                    </div>
                </div>
            </div>
        </div>

    </x-drawer>

</x-app-layout>
