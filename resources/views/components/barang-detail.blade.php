<div>
    @props(['barang'])

    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $barang->nama }}</td>
        </tr>
        <tr>
            <td>Merek</td>
            <td>:</td>
            @php
                $mereks = json_decode($barang->merek);
            @endphp
            <td>
                @foreach ($mereks as $merek)
                    <span>
                        {{ $merek->nama }} ,
                    </span>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Kualitas</td>
            <td>:</td>
            <td>{{ $barang->kualitas }}</td>
        </tr>
        <tr>
            <td>Pilihan Kualitas</td>
            <td>:</td>

            @php
                $kualitass = json_decode($barang->kualitas_select);
            @endphp
            <td>
                @foreach ($kualitass as $kualitas)
                    <span>
                        {{ $kualitas->nama }},
                    </span>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>:</td>
            <td>Rp. {{ $barang->harga }} / {{ $barang->kuantitas }}</td>
        </tr>
        <tr>
            <td>Gambar</td>
            <td>:</td>
            <td>
                <div class="bg-white rounded-lg w-32 h-32 my-2 flex items-center justify-center overflow-clip"
                    onClick="{document.getElementById('gambarBarang').showModal()}">
                    <img src="{{ $barang->gambar ? asset('storage/gambar/' . $barang->gambar) : asset('img/noimg.png') }}"
                        alt="Gambar">
                </div>

                <dialog id="gambarBarang" class="modal">
                    <div class="modal-box bg-gray-900">
                        <div class="p-8">
                            <h3 class="font-bold text-lg"></h3>
                            <div class="bg-white rounded-lg my-2">
                                <img src="{{ $barang->gambar ? asset('storage/gambar/' . $barang->gambar) : asset('img/noimg.png') }}"
                                    alt="Gambar">
                            </div>
                            <button class="btn btn-ghost w-full"
                                onClick="{document.getElementById('gambarBarang').close()}">Close X</button>
                        </div>
                    </div>
                </dialog>
            </td>
        </tr>
    </table>

</div>
