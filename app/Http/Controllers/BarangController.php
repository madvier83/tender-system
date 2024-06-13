<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use Illuminate\Support\Facades\Storage;

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
                'nama' => 'required|string|max:255',
                'merek' => 'required|string|max:255|min:5',
                'kualitas' => 'required|string|max:255',
                'kualitas_select' => 'required|string|min:5',
                'harga' => 'required|numeric|min:0',
                'kuantitas' => 'required|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
                'tgl_masuk' => 'required|date',
                'tgl_pembaruan' => 'nullable|date',
            ]
        );

        // Store the image
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/gambar', $filename);
            $validated['gambar'] = $filename;
        }

        Barang::create($validated);

        return redirect("/barang");
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
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
        // Validate the request data including the image
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'merek' => 'required|string|max:255|min:5',
            'kualitas' => 'required|string|max:255',
            'kualitas_select' => 'required|string|min:5',
            'harga' => 'required|numeric|min:0',
            'kuantitas' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'tgl_masuk' => 'required|date',
            'tgl_pembaruan' => 'nullable|date',
        ]);

        // Find the existing record
        $barang = Barang::findOrFail($barang->id);

        // Check if a new image is uploaded
        if ($request->hasFile('gambar')) {
            // Delete the old image if it exists
            if ($barang->gambar) {
                Storage::delete('public/gambar/' . $barang->gambar);
            }

            // Store the new image
            $image = $request->file('gambar');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/gambar', $filename);
            $validated['gambar'] = $filename;
        } else {
            // Remove the gambar field from the validated data
            unset($validated['gambar']);
        }

        // Update the Barang model with the validated data
        $barang->update($validated);

        // Redirect to a success page or back to the list
        return redirect("/barang")->with('success', 'Barang updated successfully!');
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
