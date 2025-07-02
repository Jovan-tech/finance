<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JurnalUmum;

class LaporanController extends Controller
{
    public function jurnalUmum(Request $request)
    {
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');

        $query = JurnalUmum::query();

        if ($dari && $sampai) {
            $query->whereBetween('tanggal', [$dari, $sampai]);
        }

        $jurnal = $query->orderBy('tanggal')->get();

        return view('laporan.jurnal', compact('jurnal', 'dari', 'sampai'));
    }

    public function bukuBesar(Request $request)
    {
        $nama_akun = $request->input('nama_akun');
        $jurnal = collect();

        $akunList = JurnalUmum::select('nama_akun')->distinct()->orderBy('nama_akun')->get();

        if ($nama_akun) {
            $jurnal = JurnalUmum::where('nama_akun', $nama_akun)
                        ->orderBy('tanggal')
                        ->get();
        }

        return view('laporan.buku_besar', compact('jurnal', 'nama_akun', 'akunList'));
    }
}
