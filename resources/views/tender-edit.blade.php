<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>

        <div class="p-8">
            <h1 class="text-4xl font-semibold mb-4 text-white">Form Pengajuan Tender</h1>
            <div class="mt-8 h-max rounded-xl max-w-lg">
                <form action="/tender/{{ $tender->id }}" method="POST">
                    @method('PUT')
                    @csrf
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Barang</span>
                        </div>
                        <select name="barang_id" id="barang_id" class="selectBarang">
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}"
                                    {{ old('barang_id') ?? $tender->barang->id == $barang->id ? 'selected' : '' }}>
                                    {{ $barang->nama }} - {{ $barang->merek }} - Rp. {{ $barang->harga }}
                                </option>
                            @endforeach
                        </select>
                        <script>
                            $(document).ready(function() {
                                $('.selectBarang').select2();
                            });
                        </script>
                        @error('barang_id')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Judul tender</span>
                        </div>
                        <input name="judul" type="text" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('judul') ?? $tender->judul }}" />
                        @error('judul')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Deskripsi tender</span>
                        </div>
                        <input name="deskripsi" type="text" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('deskripsi') ?? $tender->deskripsi }}" />
                        @error('deskripsi')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Tanggal buka</span>
                        </div>
                        <input name="tgl_buka" type="date" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('tgl_buka') ?? $tender->tgl_buka->format('Y-m-d') }}" />
                        @error('tgl_buka')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Tanggal tutup</span>
                        </div>
                        <input name="tgl_tutup" type="date" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('tgl_tutup') ?? $tender->tgl_tutup->format('Y-m-d') }}" />
                        @error('tgl_tutup')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>

                    <div class="flex gap-2 mt-8">
                        <a class="btn btn-ghost bg-gray-900 w-1/2" href="{{ url()->previous() }}">Batalkan</a>
                        <button class="btn btn-primary w-1/2">Simpan Perubahan Tender</button>
                    </div>

                </form>
            </div>
        </div>

    </x-drawer>

</x-app-layout>
