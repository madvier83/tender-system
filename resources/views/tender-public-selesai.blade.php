<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>


        <div class="p-8">
            <h1 class="text-4xl font-semibold mb-4 text-white">Tender Berlangsung</h1>
            <div class="bg-gray-900 p-4 h-max rounded-xl overflow-hidden overflow-x-auto mt-8">

                <div role="tablist" class="tabs tabs-boxed max-w-xl mb-4 bg-gray-800">
                    <a href="/tender-public/list" role="tab" class="tab">Total Tender ({{ $totalTendersCount }})</a>
                    <a href="/tender-public/active" role="tab" class="tab">Tender Aktif
                        ({{ $activeTendersCount }})</a>
                    <a href="/tender-public/selesai" role="tab" class="tab tab-active">Tender Selesai
                        ({{ $completeTendersCount }})</a>
                </div>

                <table className="table table-zebra-zebra table-xs bg-white w-full border border-collapse border-white">
                    <thead>
                        <tr class="text-left">
                            <th class="text-center">No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>barang</th>
                            <th>Tgl Buka</th>
                            <th>Tgl Tutup</th>
                            <th>Status Tender</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tenders as $tender)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $tender->judul }}</td>
                                <td class="max-w-lg">{{ $tender->deskripsi }}</td>
                                <td>{{ $tender->barang->nama }}</td>
                                <td>{{ date('d M Y', strtotime($tender->tgl_buka)) }}</td>
                                <td>{{ date('d M Y', strtotime($tender->tgl_tutup)) }}</td>
                                <td>
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

                                    <div class="rounded-lg text-black font-semibold">
                                        <div class="{{ $bgColor }} px-4 py-2 text-center rounded-lg">
                                            {{ $status }}</div>
                                    </div>
                                </td>
                                <td>
                                    <a href="/tender-public/{{ $tender->id }}" class="btn btn-info btn-xs">Buat
                                        Penawaran</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="flex items-center justify-center h-96 w-full text-xl text-white">
                    <p>
                        @if (count($tenders) <= 0)
                            Belum ada tender yang diajukan
                        @endif
                    </p>
                </div>

            </div>
        </div>

    </x-drawer>

</x-app-layout>
