<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('barang', ['barangs' => Barang::orderBy("created_at", "DESC")->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang-create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBarangRequest $request)
    {
        $validated = $request->validate(
            [
                'nama' => "required",
                'merek' => "required",
                'kualitas' => "required",
                'harga' => "required",
                'gambar' => "nullable",
                'tgl_masuk' => "required",
                'tgl_pembaruan' => "nullable",
            ]
        );

        Barang::create($validated);

        return redirect("/barang");
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('barang-edit', ["barang" => $barang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $validated = $request->validated();

        $barang->update($validated);

        return redirect("/barang");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect("/barang");
    }
}
