<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>

        <div class="p-8">
            <h1 class="text-4xl font-semibold mb-4 text-white">Update Barang</h1>
            <div class="mt-8 h-max rounded-xl max-w-lg">
                <form action="/barang/{{ $barang->id }}" method="POST">
                    @method("PUT")
                    @csrf
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Nama barang</span>
                        </div>
                        <input name="nama" type="text" placeholder="Tulis disini" class="input input-bordered w-full" value="{{ old("nama") ?? $barang->nama }}" />
                        @error("nama")
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Merek</span>
                        </div>
                        <input name="merek" type="text" placeholder="Tulis disini" class="input input-bordered w-full" value="{{ old("merek") ?? $barang->merek }}"/>
                        @error("merek")
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Kualitas barang</span>
                        </div>
                        <input name="kualitas" type="text" placeholder="Tulis disini" class="input input-bordered w-full" value="{{ old("kualitas") ?? $barang->kualitas }}">
                        @error("kualitas")
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Harga</span>
                        </div>
                        <input name="harga" type="number" placeholder="Tulis disini" class="input input-bordered w-full" value="{{ old("harga") ?? $barang->harga }}"/>
                        @error("harga")
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Gambar</span>
                        </div>
                        <input name="gambar" type="file" placeholder="Tulis disini" class="file-input input-bordered w-full" value="{{ old("gambar") ?? $barang->gambar}}"/>
                        @error("gambar")
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Tanggal barang masuk</span>
                        </div>
                        <input name="tgl_masuk" type="date" placeholder="Tulis disini" class="input input-bordered w-full" value="{{ old("tgl_masuk") ?? $barang->tgl_masuk }}"/>
                        @error("tgl_masuk")
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Tanggal pembaruan (Opsional)</span>
                        </div>
                        <input name="tgl_pembaruan" type="date" placeholder="Tulis disini" class="input input-bordered w-full" value="{{ old("tgl_pembaruan") ?? $barang->tgl_pembaruan }}"/>
                        @error("tgl_pembaruan")
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
