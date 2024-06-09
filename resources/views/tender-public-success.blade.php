<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>

        <div class="p-8 flex justify-center">
            <div class="">

                <div class="flex flex-col md:flex-row gap-16">
                    <div class=" w-[30vw]">
                        <h1 class="text-4xl font-semibold mb-4 text-white mt-8">Tender {{ $tender->judul }}</h1>
                        <p class="max-w-xl">{{ $tender->deskripsi }}</p>

                        <div class="flex gap-4 mt-8 max-w-xl">
                            <div class="bg-gray-900 rounded-xl p-6 w-full">
                                <p class="">Tanggal mulai</p>
                                <h2 class="text-xl text-white mt-2">{{ date('d M Y', strtotime($tender->tgl_buka)) }}
                                </h2>
                                <h2 class="text-xs">{{ $tender->tgl_buka->diffForHumans() }}</h2>
                            </div>

                            <div class="bg-gray-900 rounded-xl p-6 w-full">
                                <p class="">Tanggal selesai</p>
                                <h2 class="text-xl text-white mt-2">{{ date('d M Y', strtotime($tender->tgl_tutup)) }}
                                </h2>
                                <h2 class="text-xs">{{ $tender->tgl_tutup->diffForHumans() }}</h2>
                            </div>
                        </div>

                        @php
                            $now = now();
                            $tglBuka = \Carbon\Carbon::parse($tender->tgl_buka);
                            $tglTutup = \Carbon\Carbon::parse($tender->tgl_tutup);

                            if ($now < $tglBuka) {
                                $status = 'Belum Dibuka';
                                $bgColor = 'bg-blue-300';
                            } elseif ($now >= $tglBuka && $now <= $tglTutup) {
                                $status = 'Sedang Berjalan';
                                $bgColor = 'bg-emerald-300';
                            } else {
                                $status = 'Sudah Berakhir';
                                $bgColor = 'bg-rose-300';
                            }
                        @endphp

                        <div class="rounded-lg text-black font-semibold mt-4">
                            <div class="{{ $bgColor }} px-4 py-2 text-center rounded-lg">{{ $status }}</div>
                        </div>

                        <h1 class="text-2xl font-semibold mb-4 text-white mt-8">Kriteria Barang</h1>
                        <table>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $tender->barang->nama }}</td>
                            </tr>
                            <tr>
                                <td>Merek</td>
                                <td>:</td>
                                <td>{{ $tender->barang->merek }}</td>
                            </tr>
                            <tr>
                                <td>Kualitas</td>
                                <td>:</td>
                                <td>{{ $tender->barang->kualitas }}</td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>:</td>
                                <td>Rp. {{ $tender->barang->harga }}</td>
                            </tr>
                            <tr>
                                <td>Gambar</td>
                                <td>:</td>
                                <td>
                                    <div class="bg-white rounded-lg w-32 h-32 my-2"
                                        onClick="{document.getElementById('gambarBarang').showModal()}">
                                        <img src="/img/barang.png" alt="barang">
                                    </div>

                                    <dialog id="gambarBarang" className="modal">
                                        <div className="modal-box bg-gray-900">
                                            <div class="p-8">
                                                <h3 className="font-bold text-lg"></h3>
                                                <div class="bg-white rounded-lg my-2">
                                                    <img src="/img/barang.png" alt="barang">
                                                </div>
                                                <button class="btn btn-ghost w-full"
                                                    onClick="{document.getElementById('gambarBarang').close()}">Close
                                                    X</button>
                                            </div>
                                        </div>
                                    </dialog>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class=" w-[30vw]">
                        <h1 class="text-4xl font-semibold mb-4 text-white mt-8">Pengajuan Barang Terkirim!</h1>
                    </div>
                </div>

            </div>

        </div>

    </x-drawer>

</x-app-layout>
