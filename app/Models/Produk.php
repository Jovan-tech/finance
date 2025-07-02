<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori',
        'harga',
        'gambar',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    /**
     * Generate otomatis kode produk berdasarkan kode terbesar di database
     */
    public function getKodeProduk()
    {
        $sql = "SELECT IFNULL(MAX(kode_produk), 'PK-000') as kode_produk FROM produk";
        $kodeproduk = DB::select($sql);

        foreach ($kodeproduk as $kdprd) {
            $kd = $kdprd->kode_produk;
        }

        $noawal = substr($kd, -3);
        $noakhir = (int) $noawal + 1;
        $noakhir = 'PK-' . str_pad($noakhir, 3, "0", STR_PAD_LEFT);

        return $noakhir;
    }
}