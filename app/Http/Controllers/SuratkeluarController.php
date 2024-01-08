<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;
use App\Models\Suratkeluar;
use PDF;
use Illuminate\Support\Facades\Storage;

class SuratkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disposisi = Disposisi::all();
        $suratkeluar = Suratkeluar::all();
        return view('suratkeluar.index', compact('suratkeluar', 'disposisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Disposisi $disposisis)
    {
        $disposisis = Disposisi::all();
        return view('suratkeluar.create', compact('disposisis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Suratkeluar $suratkeluar)
    {
        //
        $request->validate([
            'no_surat' => 'required',
            'no_agenda' => 'required',
            'jenis_surat' => 'required',
            'tanggal_kirim' => 'required',
            'pengirim' => 'required',
            'perihal' => 'required',
            'surat' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);

        
            $file = $request->file('surat');
            $path = $file->store('surat');

            // Storage::disk('local')->put($path,file_put_contents($file));

            $suratkeluar = new Suratkeluar;

            $suratkeluar->no_surat = $request->no_surat;
            $suratkeluar->no_agenda = $request->no_agenda;
            $suratkeluar->jenis_surat = $request->jenis_surat;
            $suratkeluar->tanggal_kirim = $request->tanggal_kirim;
            $suratkeluar->pengirim = $request->pengirim;
            $suratkeluar->perihal = $request->perihal;
            // $suratkeluar->surat = $filename;

            if ($request->hasFile('surat')) {
                $file = $request->file('surat');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/surat', $filename);
                $suratkeluar->surat = $filename;
            }
            
            $suratkeluar->save();

            return redirect()->route('suratkeluar.index')->with('success', 'Surat keluar berhasil disimpan.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Suratkeluar $suratkeluar)
    {
        //
        return view('suratkeluar.show', compact('suratkeluar'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suratkeluar $suratkeluar)
    {
        $disposisis = Disposisi::all();
        return view('suratkeluar.edit', compact('suratkeluar', 'disposisis'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suratkeluar $suratkeluar)
    {
        //
        $request->validate([
            'no_agenda' => 'required',
            'jenis_surat' => 'required',
            'tanggal_kirim' => 'required',
            'no_surat' => 'required',
            'pengirim' => 'required',
            'perihal' => 'required'
        ]);

        $suratkeluar->update($request->all());

        return redirect()->route('suratkeluar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suratkeluar $suratkeluar)
    {
        //
        $suratkeluar = Suratkeluar::where('id', $suratkeluar->id)->delete();
        return redirect()->route('suratkeluar.index');
    }
}
