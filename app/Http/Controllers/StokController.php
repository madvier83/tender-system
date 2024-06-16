<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('stok', ['stoks' => stok::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stok-create', ['barangs' => Barang::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'barang_id' => 'required',
            'tipe' => 'required|string|max:255',
            'kuantitas' => 'required',
            'stok_awal' => 'required',
            'stok_setelah_exp' => 'required',
            'tanggal_exp' => 'required|date',
            'tanggal' => 'required|date',
        ]);

        // If validation passes, you can proceed with storing the data
        stok::create($validatedData);

        return redirect("/stok");
    }

    /**
     * Display the specified resource.
     */
    public function show(stok $stok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(stok $stok)
    {
        return view('stok-edit', ['stok' => $stok, 'barangs' => Barang::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, stok $stok)
    {
        $validatedData = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tipe' => 'required|string|max:255',
            'kuantitas' => 'required',
            'stok_awal' => 'required',
            'stok_setelah_exp' => 'required',
            'tanggal_exp' => 'required|date',
            'tanggal' => 'required|date',
        ]);

        $stok->update($validatedData);

        return redirect("/stok")->with('success', 'Stok updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(stok $stok)
    {
        $stok->delete();

        return redirect("/stok")->with('success', 'Stok deleted successfully.');
    }
}
