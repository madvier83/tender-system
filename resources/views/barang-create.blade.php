<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-drawer>

        <div class="p-8">
            <h1 class="text-4xl font-semibold mb-4 text-white">Tambah Barang</h1>
            <div class="mt-8 h-max rounded-xl max-w-lg">
                <form action="/barang" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Nama barang</span>
                        </div>
                        <input name="nama" type="text" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('nama') }}" />
                        @error('nama')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>

                    {{-- <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Merek</span>
                        </div>
                        <input name="merek" type="text" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('merek') }}" />
                        @error('merek')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label> --}}

                    {{-- Merek Selection --}}
                    <div class="container mx-auto mt-4">
                        <div class="mt-4 bg-gray-700 p-4 rounded-xl">
                            <div class="flex gap-2 items-end">
                                <div class="">
                                    <p>Merek</p>
                                    <input id="merekInput" type="text" placeholder="Nama Merek"
                                        class="input input-bordered w-full">
                                </div>

                                <div class="">
                                    <p>Bobot</p>
                                    <select id="bobotInputMerk" name="bobot" class="input input-bordered w-32">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}"
                                                {{ old('bobot') == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <button type="button" id="addMerekBtn" class="btn btn-primary">Tambah Merek</button>
                            </div>
                        </div>

                        <div class="mt-4 bg-gray-700 p-4 rounded-xl">
                            <h3 class="mb-4">Pilihan Merek:</h3>
                            <div id="merekContainer">
                                <!-- Dynamic content will be inserted here -->
                                @php
                                    $oldMerek = old('merek');
                                    $merekArray = is_array($oldMerek) ? $oldMerek : json_decode($oldMerek, true);
                                @endphp
                                @if (!empty($merekArray))
                                    @foreach ($merekArray as $merek)
                                        <div class="flex justify-between mt-4 p-4 bg-gray-600 rounded-xl">
                                            <h1>{{ $merek['nama'] }} - {{ $merek['bobot'] }}</h1>
                                            <div class="btn btn-xs btn-error" onclick="removeMerek(this)">Hapus Merek
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <input name="merek" type="hidden" value="{{ old('merek') }}">
                    @error('merek')
                        <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                    @enderror

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            let data = {
                                merek: {!! json_encode($merekArray ?? []) !!}
                            };

                            const merekContainer = document.getElementById('merekContainer');
                            const addMerekBtn = document.getElementById('addMerekBtn');
                            const merekInput = document.getElementById('merekInput');
                            const bobotInputMerk = document.getElementById('bobotInputMerk');

                            addMerekBtn.addEventListener('click', () => {
                                const merekNama = merekInput.value.trim();
                                const bobot = bobotInputMerk.value.trim();
                                if (merekNama && bobot) {
                                    const newMerek = {
                                        nama: merekNama,
                                        bobot: bobot
                                    };
                                    data.merek.push(newMerek);
                                    renderMerek();
                                    merekInput.value = '';
                                    bobotInputMerk.value = '1';
                                }
                            });

                            function renderMerek() {
                                merekContainer.innerHTML = '';
                                data.merek.forEach((merek, index) => {
                                    const merekDiv = document.createElement('div');
                                    merekDiv.className = 'flex justify-between mt-4 p-4 bg-gray-600 rounded-xl';

                                    merekDiv.innerHTML = `
                                        <h1>${merek.nama} - ${merek.bobot}</h1>
                                        <div class="btn btn-xs btn-error" onclick="removeMerek(${index})">Hapus Merek</div>
                                    `;

                                    merekContainer.appendChild(merekDiv);
                                });
                                updateHiddenInput();
                            }

                            function updateHiddenInput() {
                                document.querySelector('input[name="merek"]').value = JSON.stringify(data.merek);
                            }

                            window.removeMerek = (index) => {
                                data.merek.splice(index, 1);
                                renderMerek();
                            };

                            // Render any old data if available
                            renderMerek();
                        });
                    </script>




                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Deskripsi Kualitas</span>
                        </div>
                        <input name="kualitas" type="text" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('kualitas') }}">
                        @error('kualitas')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>

                    {{-- Kualitas Selection --}}
                    <div class="container mx-auto mt-4">
                        <div class="mt-4 bg-gray-700 p-4 rounded-xl">
                            <div class="flex gap-2 items-end">
                                <div class="">
                                    <p>Kualitas</p>
                                    <input id="kualitasInput" type="text" placeholder="Nama Kualitas"
                                        class="input input-bordered w-full">
                                </div>

                                <div class="">
                                    <p>Bobot</p>
                                    <select id="bobotInput" name="bobot" class="input input-bordered w-32">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}"
                                                {{ old('bobot') == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <button type="button" id="addKualitasBtn" class="btn btn-primary">Tambah
                                    Kualitas</button>
                            </div>
                        </div>

                        <div class="mt-4 bg-gray-700 p-4 rounded-xl">
                            <h3 class="mb-4">Pilihan Kualitas:</h3>
                            <div id="kualitasContainer">
                                <!-- Dynamic content will be inserted here -->
                                @php
                                    $oldKualitas = old('kualitas_select');
                                    $kualitasArray = is_array($oldKualitas)
                                        ? $oldKualitas
                                        : json_decode($oldKualitas, true);
                                @endphp
                                @if (!empty($kualitasArray))
                                    @foreach ($kualitasArray as $kualitas)
                                        <div class="flex justify-between mt-4 p-4 bg-gray-600 rounded-xl">
                                            <h1>{{ $kualitas['nama'] }} - {{ $kualitas['bobot'] }}</h1>
                                            <div class="btn btn-xs btn-error" onclick="removeKualitas(this)">Hapus
                                                Kualitas</div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <input name="kualitas_select" type="hidden" value="{{ old('kualitas_select') }}">
                    @error('kualitas_select')
                        <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                    @enderror

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            let data = {
                                kualitas: {!! json_encode($kualitasArray ?? []) !!}
                            };

                            const kualitasContainer = document.getElementById('kualitasContainer');
                            const addKualitasBtn = document.getElementById('addKualitasBtn');
                            const kualitasInput = document.getElementById('kualitasInput');
                            const bobotInput = document.getElementById('bobotInput');

                            addKualitasBtn.addEventListener('click', () => {
                                const kualitasNama = kualitasInput.value.trim();
                                const bobot = bobotInput.value.trim();
                                if (kualitasNama && bobot) {
                                    const newKualitas = {
                                        nama: kualitasNama,
                                        bobot: bobot
                                    };
                                    data.kualitas.push(newKualitas);
                                    renderKualitas();
                                    kualitasInput.value = '';
                                    bobotInput.value = '1';
                                }
                            });

                            function renderKualitas() {
                                kualitasContainer.innerHTML = '';
                                data.kualitas.forEach((kualitas, index) => {
                                    const kualitasDiv = document.createElement('div');
                                    kualitasDiv.className = 'flex justify-between mt-4 p-4 bg-gray-600 rounded-xl';

                                    kualitasDiv.innerHTML = `
                                        <h1>${kualitas.nama} - ${kualitas.bobot}</h1>
                                        <div class="btn btn-xs btn-error" onclick="removeKualitas(${index})">Hapus Kualitas</div>
                                    `;

                                    kualitasContainer.appendChild(kualitasDiv);
                                });
                                updateHiddenInput();
                            }

                            function updateHiddenInput() {
                                document.querySelector('input[name="kualitas_select"]').value = JSON.stringify(data.kualitas);
                            }

                            window.removeKualitas = (index) => {
                                data.kualitas.splice(index, 1);
                                renderKualitas();
                            };

                            // Render any old data if available
                            renderKualitas();
                        });
                    </script>


                    {{-- Archive Pilihan Kategori --}}

                    {{-- <div class="container mx-auto mt-8">
                        <h3 class="text-xl">Pilihan Kualitas:</h3>
                        <div id="kualitasContainer" class="mt-4 rounded-xl">
                            <!-- Dynamic content will be inserted here -->
                        </div>

                        <div class="mt-4 bg-gray-700 p-4 rounded-xl">
                            <div class="flex gap-2">
                                <input id="kualitasInput" type="text" placeholder="Nama Kualitas"
                                    class="input input-bordered w-full text-white">
                                <select name="bobot_kuantitas" type="number" placeholder="Tulis disini"
                                    class="input input-bordered w-32" value="{{ old('kuantitas') }}">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}"
                                            {{ old('kuantitas') == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                <div id="addKualitasBtn" class="btn btn-primary">Tambah Kualitas</div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            let data = {
                                kualitas: []
                            };

                            const kualitasContainer = document.getElementById('kualitasContainer');
                            const addKualitasBtn = document.getElementById('addKualitasBtn');
                            const kualitasInput = document.getElementById('kualitasInput');

                            addKualitasBtn.addEventListener('click', () => {
                                const kualitasNama = kualitasInput.value.trim();
                                if (kualitasNama) {
                                    const newKualitas = {
                                        nama: kualitasNama,
                                        pilihan: []
                                    };
                                    data.kualitas.push(newKualitas);
                                    renderKualitas();
                                    kualitasInput.value = '';
                                }

                                console.log(data)
                            });

                            function renderKualitas() {
                                kualitasContainer.innerHTML = '';
                                data.kualitas.forEach((kualitas, index) => {
                                    const kualitasDiv = document.createElement('div');
                                    kualitasDiv.className = 'mb-4 rounded-xl';

                                    kualitasDiv.innerHTML = `
                                            <div class="mt-4 bg-gray-700 p-4 rounded-xl">
                                                <div class="flex justify-between">
                                                    <h1 class="">${kualitas.nama}</h1>
                                                    <div class="btn btn-xs btn-error" onclick="removeKualitas(${index})">Hapus Kualitas</div>
                                                </div>
                                                <div class="mt-4 flex gap-2">
                                                    <input type="text" id="pilihanInput-${index}" placeholder="Nama Pilihan" class="input input-bordered w-full mb-2">
                                                    <input type="number" id="bobotInput-${index}" placeholder="Bobot" class="input input-bordered w-32 mb-2">
                                                    <div class="btn btn-primary" onclick="addPilihan(${index})">Tambah Pilihan</div>
                                                </div>
                                                // <div id="pilihanContainer-${index}" class="mt-4">
                                                //     <!-- Pilihan will be inserted here -->
                                                // </div>
                                            </div>
                                        `;

                                    kualitasContainer.appendChild(kualitasDiv);
                                    renderPilihan(index);
                                });
                            }

                            window.removeKualitas = (index) => {
                                data.kualitas.splice(index, 1);
                                renderKualitas();
                            };

                            window.addPilihan = (kualitasIndex) => {
                                const pilihanNama = document.getElementById(`pilihanInput-${kualitasIndex}`).value.trim();
                                const bobot = document.getElementById(`bobotInput-${kualitasIndex}`).value.trim();
                                if (pilihanNama && bobot) {
                                    const newPilihan = {
                                        nama: pilihanNama,
                                        bobot: bobot
                                    };
                                    data.kualitas[kualitasIndex].pilihan.push(newPilihan);
                                    renderPilihan(kualitasIndex);
                                }
                            };

                            function renderPilihan(kualitasIndex) {
                                const pilihanContainer = document.getElementById(`pilihanContainer-${kualitasIndex}`);
                                pilihanContainer.innerHTML = '';
                                data.kualitas[kualitasIndex].pilihan.forEach((pilihan, index) => {
                                    const pilihanDiv = document.createElement('div');
                                    pilihanDiv.className = 'flex justify-between mt-4';

                                    pilihanDiv.innerHTML = `
                                            <h1>${pilihan.nama} - ${pilihan.bobot}</h1>
                                            <div class="btn btn-xs btn-error" onclick="removePilihan(${kualitasIndex}, ${index})">Hapus Pilihan</div>
                                        `;

                                    pilihanContainer.appendChild(pilihanDiv);
                                });
                            }

                            window.removePilihan = (kualitasIndex, pilihanIndex) => {
                                data.kualitas[kualitasIndex].pilihan.splice(pilihanIndex, 1);
                                renderPilihan(kualitasIndex);
                            };

                            renderKualitas();

                        });
                    </script> --}}





                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Harga</span>
                        </div>
                        <input name="harga" type="number" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('harga') }}" />
                        @error('harga')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Satuan</span>
                        </div>
                        <input name="kuantitas" type="text" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('kuantitas') }}" />
                        @error('kuantitas')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Gambar</span>
                        </div>
                        <input name="gambar" type="file" accept="image/*" placeholder="Tulis disini"
                            class="file-input input-bordered w-full" value="{{ old('gambar') }}" />
                        @error('gambar')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>
                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Tanggal barang masuk</span>
                        </div>
                        <input name="tgl_masuk" type="date" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('tgl_masuk') }}" />
                        @error('tgl_masuk')
                            <p class="text-sm text-rose-400 mt-2">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="form-control w-full mt-2">
                        <div class="label">
                            <span class="label-text">Pembaruan (Opsional)</span>
                        </div>
                        <input name="tgl_pembaruan" type="date" placeholder="Tulis disini"
                            class="input input-bordered w-full" value="{{ old('tgl_pembaruan') }}" />
                        @error('tgl_pembaruan')
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
