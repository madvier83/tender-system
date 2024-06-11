<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>

        <div class="p-8">
            <h1 class="text-4xl font-semibold mb-4 text-white">Tabel Barang</h1>
            <a href="/barang/create" class="btn btn-primary my-4">Tambah Barang <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </a>
            <div class="bg-gray-900 p-4 h-max rounded-xl overflow-hidden overflow-x-auto">
                <table className="table table-zebra-zebra table-xs bg-white w-full border border-collapse border-white">
                    <thead>
                        <tr class="text-left">
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <th>Merk</th>
                            <th>Kualitas</th>
                            <th>Gambar</th>
                            <th class="w-52">Harga</th>
                            <th>Tgl Barang Masuk</th>
                            <th>Tgl Pembaruan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangs as $barang)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $barang->nama }}</td>
                                <td>{{ $barang->merek }}</td>
                                <td>{{ $barang->kualitas }}</td>
                                <td>

                                    <div class="bg-white rounded-lg w-16 h-16 my-2 flex items-center justify-center overflow-clip"
                                        onClick={document.getElementById('gambarBarang{{ $barang->id }}').showModal()}>
                                        <img src="{{ $barang->gambar ? asset('storage/gambar/' . $barang->gambar) : asset('img/noimg.png') }}"
                                            alt="Gambar">
                                    </div>

                                    <dialog id="gambarBarang{{ $barang->id }}" className="modal">
                                        <div className="modal-box bg-gray-900">
                                            <div class="p-8">
                                                <h3 className="font-bold text-lg">{{ $barang->nama }}</h3>
                                                <div class="bg-white rounded-lg my-2">
                                                    <img src="{{ $barang->gambar ? asset('storage/gambar/' . $barang->gambar) : asset('img/noimg.png') }}"
                                                        alt="Gambar">
                                                </div>
                                                <button class="btn btn-ghost w-full"
                                                    onClick={document.getElementById('gambarBarang{{ $barang->id }}').close()}>Close
                                                    X</button>
                                            </div>
                                        </div>
                                    </dialog>

                                </td>
                                <td>Rp. {{ $barang->harga }} / {{ $barang->kuantitas }}</td>
                                <td>{{ date('d M Y', strtotime($barang->tgl_masuk)) }}</td>
                                <td>{{ date('d M Y', strtotime($barang->tgl_pembaruan)) }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="/barang/{{ $barang->id }}/edit"
                                            class="btn btn-xs btn-success">Edit</a>
                                        <button class="btn btn-xs btn-error"
                                            onClick="document.getElementById('modalDelete{{ $barang->id }}').showModal()">Delete</button>
                                    </div>

                                    <dialog id="modalDelete{{ $barang->id }}" className="modal">
                                        <div className="modal-box">
                                            <div class="p-8 bg-gray-800 rounded-xl">
                                                <form action="/barang/{{ $barang->id }}" method="POST"
                                                    class="flex flex-col justify-center gap-4 text-xl items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-32 text-rose-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                                    </svg>
                                                    <h3 className="font-bold text-3xl max-w-sm">Apa kamu yakin ingin
                                                        menghapus barang ini secara permanen?</h3>
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="flex gap-4 mt-4">
                                                        <div class="btn btn-info"
                                                            onClick="document.getElementById('modalDelete{{ $barang->id }}').close()">
                                                            Batalkan</div>
                                                        <button class="btn btn-error">Delete Permanen</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </dialog>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </x-drawer>

</x-app-layout>
