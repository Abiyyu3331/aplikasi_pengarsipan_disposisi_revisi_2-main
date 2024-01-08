<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disposisi;
use App\Models\Suratmasuk;

class DisposisiController extends Controller
{
    public function index(Request $request, Suratmasuk $suratmasuks)
{
    $keyword = $request->input('keyword');

    $filteredDisposisi = Disposisi::query();

    if ($keyword) {
        $filteredDisposisi->where(function ($query) use ($keyword) {
            $query->where('no_agenda', 'like', "%$keyword%")
                ->orWhere('no_surat', 'like', "%$keyword%")
                ->orWhere('kepada', 'like', "%$keyword%")
                ->orWhere('keterangan', 'like', "%$keyword%")
                ->orWhere('status_surat', 'like', "%$keyword%")
                ->orWhere('tanggapan', 'like', "%$keyword%");
        });
    }

    $filteredDisposisi = $filteredDisposisi->get();

    return view('disposisi.index', compact('filteredDisposisi', 'keyword'));
}



    public function cetak()
    {
        //
        $disposisi = Disposisi::with('no_disposisi')->get();
        return view('disposisi.cetak', compact('cetak'));
    }

    public function create(Suratmasuk $suratmasuk)
    {
        $suratmasuk = Suratmasuk::all();
        return view('disposisi.create')->with('suratmasuk', $suratmasuk);
    }

    public function store(Request $request, Disposisi $disposisi)
    {
        //
        $request->validate([
            'no_surat' => 'required',
            'no_agenda' => 'required',
            'kepada' => 'required',
            'keterangan' => 'required',
            'status_surat' => 'required',
            'tanggapan' => 'required'
        ]);

        $disposisi = new Disposisi;

        $disposisi->no_surat = $request->no_surat;
        $disposisi->no_agenda = $request->no_agenda;
        $disposisi->kepada = $request->kepada;
        $disposisi->keterangan = $request->keterangan;
        $disposisi->status_surat = $request->status_surat;
        $disposisi->tanggapan = $request->tanggapan;

        $disposisi->save();

        return redirect()->route('disposisi.index');
    }

    public function show(Disposisi $disposisi)
    {
        //
        return view('disposisi.show', compact('disposisi'));

    }

    public function edit(Disposisi $disposisi)
    {
        $suratmasuks = Suratmasuk::all();
        return view('disposisi.edit', compact('disposisi', 'suratmasuks'));

    }

    public function update(Request $request, Disposisi $disposisi)
    {
        //
        $request->validate([
            'no_surat' => 'required',
            'no_agenda' => 'required',
            'kepada' => 'required',
            'keterangan' => 'required',
            'status_surat' => 'required',
            'tanggapan' => 'required'
        ]);

        $disposisi->update($request->all());

        return redirect()->route('disposisi.index');
    }

    public function destroy(Disposisi $disposisi)
    {
        $disposisi->delete(); // Menghapus data disposisi berdasarkan id

    return redirect()->route('disposisi.index');
    }
}
