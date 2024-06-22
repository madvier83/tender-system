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

                <div class="flex gap-4 mt-8">
                    <div>
                        <a href="/penawaran"
                            class="{{ request()->is('penawaran*') ? 'bg-violet-900' : 'bg-gray-700' }} cursor-pointer p-10 text-white flex flex-col gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                            <div class="w-12">
                                <img src="/img/suitcase.svg" alt="">
                            </div>
                            <h2 class="text-xl">Total Tender</h2>
                        </a>
                    </div>
                    <div>
                        <a href="/penawaran/active"
                            class="{{ request()->is('penawaran*') ? 'bg-violet-900' : 'bg-gray-700' }} cursor-pointer p-10 text-white flex flex-col gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                            <div class="w-12">
                                <img src="/img/diagram-up.svg" alt="">
                            </div>
                            <h2 class="text-xl">Tender Aktif</h2>
                        </a>
                    </div>
                    <div>
                        <a href="/penawaran/selesai"
                            class="{{ request()->is('penawaran*') ? 'bg-violet-900' : 'bg-gray-700' }} cursor-pointer p-10 text-white flex flex-col gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                            <div class="w-12">
                                <img src="/img/check.svg" alt="">
                            </div>
                            <h2 class="text-xl">Tender Selesai</h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </x-drawer>

</x-app-layout>
