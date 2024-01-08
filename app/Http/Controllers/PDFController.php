<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disposisi;
use PDF;

class PDFController extends Controller
{
    public function cetakPDF($no_surat)
{
    $disposisi = Disposisi::findOrFail($no_surat);

    $pdf = PDF::loadView('pdf.lampiran', compact('disposisi'));

    return $pdf->download('disposisi.pdf');
}
}
