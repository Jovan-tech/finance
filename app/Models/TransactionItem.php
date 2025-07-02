<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransactionItem extends Model
{
    protected $fillable = ['transaction_id', 'produk_id', 'jumlah', 'harga_satuan', 'subtotal'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}

?>
