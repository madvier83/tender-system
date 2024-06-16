<div class="drawer lg:drawer-open">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
        <!-- Page content here -->
        <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden mt-8 ml-8"><svg
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </label>

        <div class="min-h-screen p-8">
            <div class="bg-gray-800 min-h-[93.5vh] w-full h-full rounded-xl">
                {{ $slot }}
            </div>
        </div>

    </div>
    <div class="drawer-side">
        <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
        <div class="lg:py-8 lg:pl-8 h-screen">
            @auth
                <div class="p-4 w-80 bg-gray-800 text-base-content rounded-xl h-full flex flex-col gap-4">
                    <!-- Sidebar content here -->
                    <div>
                        <a href="/dashboard"
                            class="{{ request()->is('dashboard*') ? 'bg-violet-900' : 'bg-gray-900' }} cursor-pointer p-6 text-white flex gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                            <div class="w-8">
                                <img src="/img/home.svg" alt="">
                            </div>
                            <h2 class="text-xl">Home</h2>
                        </a>
                    </div>
                    <div>
                        <a href="/barang"
                            class="{{ request()->is('barang*') ? 'bg-violet-900' : 'bg-gray-900' }} cursor-pointer p-6 text-white flex gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                            <div class="w-8">
                                <img src="/img/box.svg" alt="">
                            </div>
                            <h2 class="text-xl">Barang</h2>
                        </a>
                    </div>
                    <div>
                        <a href="/tender"
                            class="{{ request()->is('tender*') ? 'bg-violet-900' : 'bg-gray-900' }} cursor-pointer p-6 text-white flex gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                            <div class="w-8">
                                <img src="/img/tender.svg" alt="">
                            </div>
                            <h2 class="text-xl">Tender</h2>
                        </a>
                    </div>
                    <div>
                        <a href="/penawaran"
                            class="{{ request()->is('penawaran*') ? 'bg-violet-900' : 'bg-gray-900' }} cursor-pointer p-6 text-white flex gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                            <div class="w-8">
                                <img src="/img/deal.svg" alt="">
                            </div>
                            <h2 class="text-xl">Pengumuman</h2>
                        </a>
                    </div>
                    <div>
                        <a href="/stok"
                            class="{{ request()->is('stok*') ? 'bg-violet-900' : 'bg-gray-900' }} cursor-pointer p-6 text-white flex gap-4 items-center hover:bg-purple-800 h-full rounded-xl">
                            <div class="w-8">
                                <img src="/img/stok.svg" alt="">
                            </div>
                            <h2 class="text-xl">Laporan</h2>
                        </a>
                    </div>
                    <div class="mt-auto">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <h1
                                class="bg-gray-900 cursor-pointer px-8 py-4 text-white flex items-center mb-2 h-full w-full rounded-xl">
                                {{ auth()->user()->email }}
                            </h1>
                            <button
                                class="bg-gray-900 cursor-pointer px-8 py-4 text-white flex items-center hover:bg-rose-900 h-full w-full rounded-xl">
                                <div class="w-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                    </svg>
                                </div>
                                <h2 class="text-">Logout</h2>
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

        </div>

    </div>
</div>
