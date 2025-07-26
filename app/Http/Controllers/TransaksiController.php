<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Produk;
use App\Models\JurnalUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        $topProduk = Produk::orderBy('jumlah_laku', 'desc')->take(3)->pluck('id')->toArray();

        return view('transaksi.view', compact('produk', 'topProduk'));
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'items' => 'required|array',
            'items.*.produk_id' => 'required|exists:produk,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $totalHarga = 0;

            // Buat transaksi utama
            $transaction = Transaction::create([
                'tanggal_transaksi' => now(),
                'total_harga' => 0,
            ]);

            foreach ($data['items'] as $item) {
                $produk = Produk::findOrFail($item['produk_id']);
                $subtotal = $produk->harga * $item['jumlah'];
                $produk->increment('jumlah_laku', $item['jumlah']);

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'produk_id' => $produk->id,
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $produk->harga,
                    'subtotal' => $subtotal,
                ]);

                $totalHarga += $subtotal;
            }

            // Update total harga di transaksi
            $transaction->update(['total_harga' => $totalHarga]);

            // Buat jurnal umum (misalnya: Debit Kas, Kredit Penjualan)
            JurnalUmum::create([
                'tanggal' => now(),
                'nama_akun' => 'Kas',
                'kode_akun' => 101,
                'debit' => $totalHarga,
                'kredit' => 0,
            ]);

            JurnalUmum::create([
                'tanggal' => now(),
                'nama_akun' => 'Penjualan',
                'kode_akun' => 401,
                'debit' => 0,
                'kredit' => -$totalHarga,
            ]);

            DB::commit();

            return response()->json(['message' => 'Transaksi berhasil disimpan!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function riwayat()
    {
        $transaksi = Transaction::orderBy('tanggal_transaksi', 'desc')->get();
        return view('transaksi.riwayat', compact('transaksi'));
    }


    public function struk($id)
    {
        $transaksi = Transaction::with('items.produk')->findOrFail($id);

        $subtotal = $transaksi->items->sum('subtotal');
        $pajak = $subtotal * 0.10;
        $total = $subtotal + $pajak;

        return view('transaksi.struk', compact('transaksi', 'subtotal', 'pajak', 'total'));
    }

}

?>