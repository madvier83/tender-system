<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>

        <div class="p-8 flex justify-center">
            <div class="">

                <div class="flex gap-32">
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

                        <div class="flex w-full items-center justify-between gap-4 mt-4">

                            <input type="text" class="input w-full" id="link"
                                value="http://localhost:8000/tender-public/{{ $tender->id }}" readonly>

                            <button class="btn btn-primary" onclick="copyLink()">Copy Link</button>
                        </div>

                        <script>
                            function copyLink() {
                                // Get the text field
                                var copyText = document.getElementById("link");

                                // Select the text field
                                copyText.select();
                                copyText.setSelectionRange(0, 99999); // For mobile devices

                                // Copy the text inside the text field
                                document.execCommand("copy");

                                // Alert the copied text
                                alert("Copied the text: " + copyText.value);
                            }
                        </script>

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
                                <td>Rp. {{ $tender->barang->harga }} / {{ $tender->barang->kuantitas }}</td>
                            </tr>
                            <tr>
                                <td>Gambar</td>
                                <td>:</td>
                                <td>
                                    <div class="bg-white rounded-lg w-32 h-32 my-2 flex items-center justify-center overflow-clip"
                                        onClick="{document.getElementById('gambarBarang').showModal()}">
                                        <img src="{{ $tender->barang->gambar ? asset('storage/gambar/' . $tender->barang->gambar) : asset('img/noimg.png') }}"
                                            alt="Gambar">
                                    </div>

                                    <dialog id="gambarBarang" className="modal">
                                        <div className="modal-box bg-gray-900">
                                            <div class="p-8">
                                                <h3 className="font-bold text-lg"></h3>
                                                <div class="bg-white rounded-lg my-2">
                                                    <img src="{{ $tender->barang->gambar ? asset('storage/gambar/' . $tender->barang->gambar) : asset('img/noimg.png') }}"
                                                        alt="Gambar">
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
                        <h1 class="text-4xl font-semibold mb-4 text-white mt-8">Penawaran Tender</h1>
                        <div class="h-[75vh] flex flex-col gap-4 overflow-y-scroll rounded-xl pr-8">
                            @foreach ($tender->penawaran as $penawaran)
                                <div class="bg-gray-900 p-6 rounded-xl">
                                    <div class="flex justify-between">
                                        <div class="">
                                            <h1 class="text-xl text-white">
                                                {{ $penawaran->vendor }}
                                            </h1>
                                            <p>{{ $penawaran->alamat }}</p>
                                        </div>
                                        <div class="text-sm text-right">
                                            <p>{{ $penawaran->email }}</p>
                                            <p>{{ $penawaran->telepon }}</p>
                                        </div>
                                    </div>
                                    <div class="border-b border-dashed my-4 border-gray-500"></div>
                                    <table class="p-0 text-sm">
                                        <tr>
                                            <td class="px-0">Nama</td>
                                            <td>:</td>
                                            <td>{{ $penawaran->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-0">Merek</td>
                                            <td>:</td>
                                            <td>{{ $penawaran->merek }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-0">Kualitas</td>
                                            <td>:</td>
                                            <td>{{ $penawaran->kualitas }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-0">Kuantitas</td>
                                            <td>:</td>
                                            <td>{{ $penawaran->kuantitas }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-0">Satuan</td>
                                            <td>:</td>
                                            <td>{{ $penawaran->satuan }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-0">Harga</td>
                                            <td>:</td>
                                            <td>Rp. {{ $penawaran->harga }} / {{ $penawaran->satuan }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-0">Gambar</td>
                                            <td>:</td>
                                            <td>
                                                <div class="bg-gray-700 rounded-lg w-32 h-32 my-2 flex items-center justify-center overflow-hidden"
                                                    onClick="{document.getElementById('gambarBarang{{ $penawaran->id }}').showModal()}">
                                                    <img src="{{ $penawaran->gambar ? asset('storage/gambar/' . $penawaran->gambar) : asset('img/noimg.png') }}"
                                                        alt="Gambar">
                                                </div>

                                                <dialog id="gambarBarang{{ $penawaran->id }}" className="modal">
                                                    <div className="modal-box bg-gray-900">
                                                        <div class="p-8">
                                                            <h3 className="font-bold text-lg"></h3>
                                                            <div class="bg-white rounded-lg my-2">

                                                                <img src="{{ $penawaran->gambar ? asset('storage/gambar/' . $penawaran->gambar) : asset('img/noimg.png') }}"
                                                                    alt="Gambar">
                                                            </div>
                                                            <button class="btn btn-ghost w-full"
                                                                onClick="{document.getElementById('gambarBarang{{ $penawaran->id }}').close()}">Close
                                                                X</button>
                                                        </div>
                                                    </div>
                                                </dialog>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endforeach

                            @if (count($tender->penawaran) == 0)
                                <div class="bg-gray-900 p-6 rounded-xl">
                                    <div class="flex justify-between">
                                        <div class="">
                                            <h1 class="text-xl text-white">
                                                Belum Ada Penawaran
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </x-drawer>

</x-app-layout>
