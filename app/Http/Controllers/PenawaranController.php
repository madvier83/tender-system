<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use App\Models\Tender;
use Illuminate\Http\Request;

class PenawaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('penawaran', ['tenders' => Tender::with('barang')->orderBy("created_at", "DESC")->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tender_id' => 'required',
            'vendor' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:255',
            'tgl_pengajuan' => 'required|date',
            'tgl_selesai' => 'required|date',
            'nama' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'kualitas' => 'required|string|max:255',
            'satuan' => 'required|integer',
            'harga' => 'required|numeric|min:0',
            'kuantitas' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tgl_masuk' => 'required|date',
            'tgl_pembaruan' => 'nullable|date',
        ]);

        Penawaran::create($validated);

        return redirect("/tender");
    }

    public function publicStore(Request $request)
    {
        $validated = $request->validate([
            'tender_id' => 'required',
            'vendor' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:255',
            'tgl_pengajuan' => 'required|date',
            'tgl_selesai' => 'required|date',
            'nama' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'kualitas' => 'required|string|max:255',
            'satuan' => 'required|integer',
            'harga' => 'required|numeric|min:0',
            'kuantitas' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'tgl_masuk' => 'required|date',
            'tgl_pembaruan' => 'nullable|date',
        ]);

        // Store the image
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/gambar', $filename);
            $validated['gambar'] = $filename;
        }

        Penawaran::create($validated);

        return redirect("tender-public/" . $request->tender_id . "/success");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $t = Tender::with(['penawaran' => function ($query) {
            $query->orderBy('harga', 'asc');
        }])->where('id', $id)->get()->first();

        return view('penawaran-show', ['tender' => $t]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penawaran $penawaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penawaran $penawaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penawaran $penawaran)
    {
        //
    }
}
