<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>

        <div class="p-8">
            <h1 class="text-4xl font-semibold mb-4 text-white">Laporan Keluar Masuk Barang</h1>
            <a href="/stok/create" class="btn btn-primary my-4">Buat Laporan <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </a>
            <div class="bg-gray-900 p-4 h-max rounded-xl overflow-hidden overflow-x-auto">
                <table className="table table-zebra-zebra table-xs bg-white w-full border border-collapse border-white">
                    <thead>
                        <tr class="text-left">
                            <th class="text-center">No</th>
                            <th>Barang</th>
                            <th>Tipe</th>
                            <th>Kuantitas</th>
                            <th>Stok Awal</th>
                            <th>Stok Setelah Exp</th>
                            <th>Tanggal Exp</th>
                            <th>Tanggal masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stoks as $stok)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $stok->barang->nama }}</td>
                                <td>
                                    <p
                                        class="capitalize {{ $stok->tipe == 'masuk' ? 'bg-emerald-400' : 'bg-rose-400' }} text-black px-2 rounded-md font-semibold">
                                        {{ $stok->tipe }}
                                    </p>
                                </td>
                                <td>{{ $stok->kuantitas }}</td>
                                <td>{{ $stok->stok_awal }}</td>
                                <td>{{ $stok->stok_setelah_exp }}</td>
                                <td>{{ date('d M Y', strtotime($stok->tanggal_exp)) }}</td>
                                <td>{{ date('d M Y', strtotime($stok->tanggal)) }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="/stok/{{ $stok->id }}/edit"
                                            class="btn btn-xs btn-success">Edit</a>
                                        <button class="btn btn-xs btn-error"
                                            onClick="document.getElementById('modalDelete{{ $stok->id }}').showModal()">Delete</button>
                                    </div>

                                    <dialog id="modalDelete{{ $stok->id }}" className="modal">
                                        <div className="modal-box">
                                            <div class="p-8 bg-gray-800 rounded-xl">
                                                <form action="/stok/{{ $stok->id }}" method="POST"
                                                    class="flex flex-col justify-center gap-4 text-xl items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-32 text-rose-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                                    </svg>
                                                    <h3 className="font-bold text-3xl max-w-sm">Apa kamu yakin ingin
                                                        menghapus laporan ini secara permanen?</h3>
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="flex gap-4 mt-4">
                                                        <div class="btn btn-info"
                                                            onClick="document.getElementById('modalDelete{{ $stok->id }}').close()">
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
                <div class="flex items-center justify-center h-96 w-full text-xl text-white">
                    <p>
                        @if (count($stoks) <= 0)
                            Belum ada data barang yang dibuat
                        @endif
                    </p>
                </div>
            </div>
        </div>

    </x-drawer>

</x-app-layout>
