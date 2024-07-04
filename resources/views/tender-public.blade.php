<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>

        <div class="px-16 py-8 flex">
            <div class="">
                <div class="flex flex-col md:flex-row gap-16">
                    <div class="min-w-[30vw]">
                        <h1 class="text-4xl font-semibold mb-4 text-white mt-8">Tender {{ $tender->judul }}</h1>
                        <p class="max-w-xl">{{ $tender->deskripsi }}</p>

                        <div class="flex gap-4 mt-8 max-w-xl">
                            <div class="bg-gray-900 rounded-xl p-6 w-full">
                                <p class="">Tanggal mulai</p>
                                <h2 class="text-xl text-white mt-2">{{ date('d M Y', strtotime($tender->tgl_buka)) }}
                                </h2>
                                <h2 class="text-xs">{{ $tender->tgl_buka?->diffForHumans() }}</h2>
                            </div>

                            <div class="bg-gray-900 rounded-xl p-6 w-full">
                                <p class="">Tanggal selesai</p>
                                <h2 class="text-xl text-white mt-2">{{ date('d M Y', strtotime($tender->tgl_tutup)) }}
                                </h2>
                                <h2 class="text-xs">{{ $tender->tgl_tutup?->diffForHumans() }}</h2>
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
                        <x-barang-detail :barang="$tender->barang" />
                    </div>

                    <div class="">
                        @if ($now >= $tglBuka && $now <= $tglTutup)
                            <h1 class="text-4xl font-semibold mb-4 text-white mt-8">Form Pengajuan Penawaran Barang</h1>

                            <form action="/tender-public/{{ $tender->id }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="tender_id" value="{{ $tender->id }}">
                                <div class="flex flex-col gap-8">
                                    <div class="w-full">
                                        <h1 class="text-xl font-semibold mb-4 mt-8">1. Identitas Vendor</h1>
                                        <div class="mt-4 h-max rounded-xl max-w-lg">
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Nama vendor</span>
                                                </div>
                                                <input name="vendor" type="text" placeholder="Tulis disini"
                                                    class="input input-bordered w-full" value="{{ old('vendor') ?? auth()->user()->name }}" />
                                                @error('vendor')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Nomor Telepon</span>
                                                </div>
                                                <input name="telepon" type="number" placeholder="Tulis disini"
                                                    class="input input-bordered w-full" value="{{ old('telepon') }}" />
                                                @error('telepon')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Email</span>
                                                </div>
                                                <input name="email" type="email" placeholder="Tulis disini"
                                                    class="input input-bordered w-full" value="{{ old('email') ?? auth()->user()->email  }}">
                                                @error('email')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Alamat</span>
                                                </div>
                                                <input name="alamat" type="text" placeholder="Tulis disini"
                                                    class="input input-bordered w-full" value="{{ old('alamat') }}">
                                                @error('alamat')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Tanggal pengajuan</span>
                                                </div>
                                                <input name="tgl_pengajuan" type="date" placeholder="Tulis disini"
                                                    class="input input-bordered w-full"
                                                    value="{{ old('tgl_pengajuan', date('Y-m-d')) }}" />
                                                @error('tgl_pengajuan')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            @php
                                                $date = \Carbon\Carbon::parse($tender->tgl_tutup)->format('Y-m-d');
                                            @endphp
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Tanggal selesai</span>
                                                </div>
                                                <input name="tgl_selesai" type="date" placeholder="Tulis disini"
                                                    class="input input-bordered w-full cursor-not-allowed" readonly
                                                    value="{{ $date }}" />
                                                @error('tgl_selesai')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                        </div>
                                    </div>

                                    <div class="w-full">
                                        <h1 class="text-xl font-semibold mb-4 mt-8">2. Kriteria Barang</h1>
                                        <div class="mt-4 h-max rounded-xl max-w-lg">
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Nama barang</span>
                                                </div>
                                                <input name="nama" type="text" placeholder="Tulis disini"
                                                    class="input input-bordered w-full cursor-not-allowed"
                                                    value="{{ $tender->barang->nama }}" readonly />
                                                @error('nama')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>

                                            @php
                                                $options = json_decode($tender->barang->merek, true);
                                            @endphp
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Merek</span>
                                                </div>
                                                <select name="merek" class="input input-bordered w-full">
                                                    <option value="" disabled selected>Pilih Merek</option>
                                                    @foreach ($options as $option)
                                                        <option value="{{ json_encode($option) }}"
                                                            {{ old('merek') == json_encode($option) ? 'selected' : '' }}>
                                                            {{ $option['nama'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('merek')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>

                                            @php
                                                $options = json_decode($tender->barang->kualitas_select, true);
                                            @endphp
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Kualitas</span>
                                                </div>
                                                <select name="kualitas_select" class="input input-bordered w-full">
                                                    <option value="" disabled selected>Pilih Kualitas</option>
                                                    @foreach ($options as $option)
                                                        <option value="{{ json_encode($option) }}""
                                                            {{ old('kualitas_select') == json_encode($option) ? 'selected' : '' }}>
                                                            {{ $option['nama'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('kualitas_select')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>

                                            <div class="flex gap-2">
                                                <label class="form-control w-full mt-2">
                                                    <div class="label">
                                                        <span class="label-text">Deskripsi Kualitas</span>
                                                    </div>
                                                    <input name="kualitas" type="text" placeholder="Tulis disini"
                                                        class="input input-bordered w-full"
                                                        value="{{ old('kualitas') }}">
                                                    @error('kualitas')
                                                        <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                    @enderror
                                                </label>
                                                {{-- <label class="form-control mt-2 w-24">
                                                    <div class="label">
                                                        <span class="label-text">Bobot</span>
                                                    </div>
                                                    <select name="bobot_kuantitas" type="number"
                                                        placeholder="Tulis disini" class="input input-bordered w-full"
                                                        value="{{ old('kuantitas') }}">
                                                        @for ($i = 1; $i <= 10; $i++)
                                                            <option value="{{ $i }}"
                                                                {{ old('kuantitas') == $i ? 'selected' : '' }}>
                                                                {{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                    @error('kualitas')
                                                        <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                    @enderror
                                                </label> --}}
                                            </div>
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Satuan</span>
                                                </div>
                                                <input name="satuan" type="text" placeholder="Tulis disini"
                                                    class="input input-bordered w-full cursor-not-allowed" readonly
                                                    value="{{ $tender->barang->kuantitas }}" />
                                                @error('satuan')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Harga</span>
                                                </div>
                                                <input name="harga" type="number" placeholder="Tulis disini"
                                                    class="input input-bordered w-full"
                                                    value="{{ old('harga') }}" />
                                                @error('harga')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Kuantitas</span>
                                                </div>
                                                <div class="flex">
                                                    <input name="kuantitas" type="number" placeholder="Tulis disini"
                                                        class="input input-bordered w-full"
                                                        value="{{ old('kuantitas') }}">
                                                </div>
                                                @error('kuantitas')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Gambar</span>
                                                </div>
                                                <input name="gambar" type="file" accept="image/*"
                                                    placeholder="Tulis disini"
                                                    class="file-input input-bordered w-full"
                                                    value="{{ old('gambar') }}" />
                                                @error('gambar')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Tanggal barang masuk</span>
                                                </div>
                                                <input name="tgl_masuk" type="date" placeholder="Tulis disini"
                                                    class="input input-bordered w-full"
                                                    value="{{ old('tgl_masuk') }}" />
                                                @error('tgl_masuk')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Tanggal expired</span>
                                                </div>
                                                <input name="tgl_exp" type="date" placeholder="Tulis disini"
                                                    class="input input-bordered w-full"
                                                    value="{{ old('tgl_exp') }}" />
                                                @error('tgl_exp')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Pembaruan (Opsional)</span>
                                                </div>
                                                <input name="tgl_pembaruan" type="date" placeholder="Tulis disini"
                                                    class="input input-bordered w-full"
                                                    value="{{ old('tgl_pembaruan') }}" />
                                                @error('tgl_pembaruan')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>

                                            <div class="flex gap-2 my-8">
                                                <button class="btn btn-primary w-full">Ajukan Penawaran</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

            </div>

        </div>

    </x-drawer>

</x-app-layout>
