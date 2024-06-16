<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>

        <div class="p-8">
            <h1 class="text-4xl font-semibold mb-4 text-white">Buat Laporan</h1>
            <div class="mt-8 h-max rounded-xl max-w-lg">
                <form action="/stok" method="POST" enctype="multipart/form-data">
                    @csrf


                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Barang</span>
                        </div>
                        <select name="barang_id" id="barang_id" class="selectBarang">
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}"
                                    {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                    {{ $barang->nama }}
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
                            <span class="label-text">Tipe Laporan</span>
                        </div>
                        <select name="tipe" type="date" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('tipe') }}">
                            <option value="masuk">Barang Masuk</option>
                            <option value="keluar">Barang Keluar</option>
                        </select>
                        @error('tipe')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Kuantitas</span>
                        </div>
                        <input name="kuantitas" type="text" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('kuantitas') }}" />
                        @error('kuantitas')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Stok awal</span>
                        </div>
                        <input name="stok_awal" type="text" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('stok_awal') }}" />
                        @error('stok_awal')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Stok setelah expired</span>
                        </div>
                        <input name="stok_setelah_exp" type="text" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('stok_setelah_exp') }}" />
                        @error('stok_setelah_exp')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Tanggal masuk</span>
                        </div>
                        <input name="tanggal" type="date" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('tanggal') }}" />
                        @error('tanggal')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Tanggal Expired</span>
                        </div>
                        <input name="tanggal_exp" type="date" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('tanggal_exp') }}" />
                        @error('tanggal_exp')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>


                    <div class="flex gap-2 mt-8">
                        <a class="btn btn-ghost bg-gray-900 w-1/2" href="{{ url()->previous() }}">Batalkan</a>
                        <button class="btn btn-primary w-1/2">Simpan</button>
                    </div>

                </form>
            </div>
        </div>

    </x-drawer>

</x-app-layout>
