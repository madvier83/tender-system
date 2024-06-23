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
        $tenders = Tender::with('barang')->orderBy("created_at", "DESC")->get();
        $totalTendersCount = Tender::count();
        $activeTendersCount = Tender::where('tgl_tutup', '>', now())->count();
        $completeTendersCount = Tender::where('tgl_tutup', '<', now())->count();

        return view('penawaran', [
            'tenders' => $tenders,
            'totalTendersCount' => $totalTendersCount,
            'activeTendersCount' => $activeTendersCount,
            'completeTendersCount' => $completeTendersCount
        ]);
    }

    public function indexAktif()
    {
        $tenders = Tender::with('barang')
            ->where('tgl_tutup', '>', now())
            ->orderBy("created_at", "DESC")
            ->get();
        $totalTendersCount = Tender::count();
        $activeTendersCount = Tender::where('tgl_tutup', '>', now())->count();
        $completeTendersCount = Tender::where('tgl_tutup', '<', now())->count();

        return view('penawaran-aktif', [
            'tenders' => $tenders,
            'totalTendersCount' => $totalTendersCount,
            'activeTendersCount' => $activeTendersCount,
            'completeTendersCount' => $completeTendersCount
        ]);
    }

    public function indexSelesai()
    {
        $tenders = Tender::with('barang')
            ->where('tgl_tutup', '<', now())
            ->orderBy("created_at", "DESC")
            ->get();
        $totalTendersCount = Tender::count();
        $activeTendersCount = Tender::where('tgl_tutup', '>', now())->count();
        $completeTendersCount = Tender::where('tgl_tutup', '<', now())->count();

        return view('penawaran-selesai', [
            'tenders' => $tenders,
            'totalTendersCount' => $totalTendersCount,
            'activeTendersCount' => $activeTendersCount,
            'completeTendersCount' => $completeTendersCount
        ]);
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
            'satuan' => 'required',
            'harga' => 'required|numeric|min:0',
            'kuantitas' => 'required|integer|min:1',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tgl_masuk' => 'required|date',
            'tgl_exp' => 'required|date',
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

            // 'ranking' => 'required|string|max:255',

            'nama' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'kualitas' => 'required|string|max:255',
            'kualitas_select' => 'required|string|max:255',
            'satuan' => 'required',
            'harga' => 'required|numeric|min:0',
            'kuantitas' => 'required|integer|min:1',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
            'tgl_masuk' => 'required|date',
            'tgl_exp' => 'required|date',
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

        // Recalculate ranks for all Penawaran records for the given tender_id
        $this->recalculateRanks($request->tender_id);

        return redirect("tender-public/" . $request->tender_id . "/success");
    }

    private function recalculateRanks($tenderId)
    {
        $penawaranRecords = Penawaran::where('tender_id', $tenderId)->get();

        if ($penawaranRecords->isEmpty()) {
            return;
        }

        $prices = $penawaranRecords->pluck('harga');
        $min_price = $prices->min();
        $max_price = $prices->max();

        foreach ($penawaranRecords as $penawaran) {
            // Normalize the price
            if ($max_price != $min_price) {
                $normalized_price = 10 - 9 * (($penawaran->harga - $min_price) / ($max_price - $min_price));
                // $normalized_price = 1 + 9 * (($penawaran->harga - $min_price) / ($max_price - $min_price));
            } else {
                $normalized_price = 5.5; // Midpoint of 1-10
            }

            // Decode JSON fields and calculate rank
            $kualitas_bobot = json_decode($penawaran->kualitas_select)->bobot;
            $merek_bobot = json_decode($penawaran->merek)->bobot;
            $rank = ($normalized_price * 0.3) + ($kualitas_bobot * 0.4) + ($merek_bobot * 0.2);

            if ($penawaran->tgl_pembaruan) {
                $rank += 0.1;
            }

            // Update the rank
            $penawaran->ranking = $rank;
            $penawaran->save();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $t = Tender::with(['penawaran' => function ($query) {
            $query->orderBy('ranking', 'desc');
        }])->where('id', $id)->get()->first();

        if (is_null($t)) {
            abort(404, 'Tender not found');
        }

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
