<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>

        <div class="p-20">
            <div class="max-w-7xl px-16 flex flex-col h-full">

                <div class="overflow-hidden shadow-sm rounded-lg">
                    <div class="pb-6 text-white text-4xl">
                        Welcome vendor
                    </div>
                </div>

                <div class="flex gap-4 mt-8">
                    <div>
                        <a href="/tender-public/list"
                            class="bg-gray-700 cursor-pointer p-10 text-white flex flex-col gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                            <div class="w-12">
                                <img src="/img/suitcase.svg" alt="">
                            </div>
                            <h2 class="text-xl">Total Tender</h2>
                        </a>
                    </div>
                    <div>
                        <a href="/tender-public/list"
                            class="bg-gray-700 cursor-pointer p-10 text-white flex flex-col gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                            <div class="w-12">
                                <img src="/img/diagram-up.svg" alt="">
                            </div>
                            <h2 class="text-xl">Tender Aktif</h2>
                        </a>
                    </div>
                    <div>
                        <a href="/tender-public/list"
                            class="bg-gray-700 cursor-pointer p-10 text-white flex flex-col gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
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
