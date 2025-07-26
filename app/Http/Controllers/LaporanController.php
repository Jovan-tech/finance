<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

        $jurnal = $query->orderBy('tanggal', 'desc')->get();

        // Hitung total debit dan kredit
        $totalDebit = $jurnal->sum('debit');
        $totalKredit = $jurnal->sum('kredit');

        return view('laporan.jurnal', compact('jurnal', 'dari', 'sampai', 'totalDebit', 'totalKredit'));
    }

    public function bukuBesar(Request $request)
    {
        $selectedBulan = $request->input('bulan', Carbon::now()->format('Y-m'));
        $selectedKodeAkun = $request->input('kode_akun');

        $jurnal = collect();
        $saldoAwal = 0;
        $selectedAkun = null;

        $akunList = JurnalUmum::select('kode_akun', 'nama_akun')
            ->distinct()
            ->orderBy('kode_akun')
            ->get();

        if ($selectedKodeAkun) {
            $selectedAkun = $akunList->firstWhere('kode_akun', $selectedKodeAkun);
            
            $tanggalAwalBulan = Carbon::parse($selectedBulan . '-01')->startOfMonth();

            $saldoAwal = JurnalUmum::where('kode_akun', $selectedKodeAkun)
                ->where('tanggal', '<', $tanggalAwalBulan)
                ->sum(DB::raw('debit - kredit'));

            $tanggalAkhirBulan = $tanggalAwalBulan->copy()->endOfMonth();
            $jurnal = JurnalUmum::where('kode_akun', $selectedKodeAkun)
                ->whereBetween('tanggal', [$tanggalAwalBulan, $tanggalAkhirBulan])
                ->orderBy('tanggal', 'asc')
                ->orderBy('created_at', 'asc')
                ->get();

            if ($jurnal->isNotEmpty()) {
                $timestamps = $jurnal->pluck('created_at')->unique();

                $relatedEntries = JurnalUmum::whereIn('created_at', $timestamps)->get()->groupBy(function($entry) {
                    return $entry->created_at->toDateTimeString();
                });

                // ⭐️ BAGIAN YANG DIPERBAIKI ⭐️
                foreach ($jurnal as $item) {
                    $contraAccountNames = [];
                    $contraAccountCodes = []; // <-- Tambahkan array untuk menampung kode akun
                    $timestampKey = $item->created_at->toDateTimeString();

                    if (isset($relatedEntries[$timestampKey])) {
                        foreach ($relatedEntries[$timestampKey] as $related) {
                            if ($related->kode_akun != $selectedKodeAkun) {
                                $contraAccountNames[] = $related->nama_akun;
                                $contraAccountCodes[] = $related->kode_akun; // <-- Simpan kode akun lawan
                            }
                        }
                    }
                    
                    // Siapkan data untuk kolom Keterangan dan Ref
                    $item->keterangan_display = !empty($contraAccountNames) ? implode(', ', array_unique($contraAccountNames)) : '(Keterangan Transaksi)';
                    $item->ref_display = !empty($contraAccountCodes) ? implode(', ', array_unique($contraAccountCodes)) : ''; // <-- Siapkan kode akun untuk kolom Ref
                }
            }
        }

        return view('laporan.buku_besar', compact(
            'jurnal',
            'akunList',
            'selectedBulan',
            'selectedKodeAkun',
            'selectedAkun',
            'saldoAwal'
        ));
    }
}