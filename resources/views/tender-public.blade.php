<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>

        <div class="p-8 flex justify-center">
            <div class="">

                <div class="flex flex-col md:flex-row gap-32">
                    <div class=" w-[30vw]">
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
                                                    class="input input-bordered w-full" value="{{ old('vendor') }}" />
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
                                                    class="input input-bordered w-full" value="{{ old('email') }}">
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
                                                    value="{{ old('tgl_pengajuan') }}" />
                                                @error('tgl_pengajuan')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Tanggal selesai</span>
                                                </div>
                                                <input name="tgl_selesai" type="date" placeholder="Tulis disini"
                                                    class="input input-bordered w-full"
                                                    value="{{ old('tgl_selesai') }}" />
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
                                                    class="input input-bordered w-full"
                                                    value="{{ old('nama') }}" />
                                                @error('nama')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label>
                                            {{-- <label class="form-control w-full mt-2">
                                                <div class="label">
                                                    <span class="label-text">Merek</span>
                                                </div>
                                                <input name="merek" type="text" placeholder="Tulis disini"
                                                    class="input input-bordered w-full"
                                                    value="{{ old('merek') }}" />
                                                @error('merek')
                                                    <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                                                @enderror
                                            </label> --}}
                                            <div class="flex gap-2">
                                                <label class="form-control w-full mt-2">
                                                    <div class="label">
                                                        <span class="label-text">Merek</span>
                                                    </div>
                                                    <input name="merek" type="text" placeholder="Tulis disini"
                                                        class="input input-bordered w-full"
                                                        value="{{ old('merek') }}">
                                                    @error('merek')
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
                                            <div class="flex gap-2">
                                                <label class="form-control w-full mt-2">
                                                    <div class="label">
                                                        <span class="label-text">Kualitas barang</span>
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
                                                    class="input input-bordered w-full"
                                                    value="{{ old('satuan') }}" />
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
