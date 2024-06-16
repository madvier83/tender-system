<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Tender;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function welcome()
    {
        return view('tender-public-dashboard');
    }
    public function index()
    {
        return view('tender', ['tenders' => Tender::with('barang')->orderBy("created_at", "DESC")->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tender-create', ['barangs' => Barang::orderBy("created_at", "DESC")->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'barang_id' => 'required|exists:barangs,id',
            'tgl_buka' => 'required|date|after_or_equal:today',
            'tgl_tutup' => 'required|date|after:tgl_buka',
        ]);

        Tender::create($validated);

        return redirect('/tender');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tender $tender)
    {
        $t = Tender::with(['penawaran' => function ($query) {
            $query->orderBy('ranking', 'desc');
        }])->where('id', $tender->id)->get()->first();

        if (is_null($t)) {
            abort(404, 'Tender not found');
        }

        return view('tender-show', ['tender' => $t]);
    }

    public function public()
    {

        $t = Tender::where('tgl_tutup', '>', Carbon::now())->get();

        return view('tender-public-list', ['tenders' => $t]);
    }
    public function publicShow($id)
    {
        $t = Tender::with(['penawaran' => function ($query) {
            $query->orderBy('ranking', 'desc');
        }])->where('id', $id)->get()->first();

        if (is_null($t)) {
            abort(404, 'Tender not found');
        }

        return view('tender-public', ['tender' => $t]);
    }
    public function publicSuccess($id)
    {
        $t = Tender::with(['penawaran' => function ($query) {
            $query->orderBy('ranking', 'desc');
        }])->where('id', $id)->get()->first();

        return view('tender-public-success', ['tender' => $t]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tender $tender)
    {
        return view('tender-edit', ["tender" => $tender, 'barangs' => Barang::orderBy("created_at", "DESC")->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tender $tender)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'barang_id' => 'required|exists:barangs,id',
            'tgl_buka' => 'required|date|after_or_equal:today',
            'tgl_tutup' => 'required|date|after:tgl_buka',
        ]);

        Tender::where("id", $tender->id)->update($validated);

        return redirect("/tender");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tender $tender)
    {
        $tender->delete();
        return redirect("/tender");
    }
}
