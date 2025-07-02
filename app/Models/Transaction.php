<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Transaction extends Model
{
    protected $fillable = ['tanggal_transaksi', 'total_harga'];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}

?>
