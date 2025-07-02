<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class JurnalUmum extends Model
{
    protected $table = "jurnal_umum";

    protected $fillable = ['tanggal', 'nama_akun', 'kode_akun', 'debit', 'kredit'];
}

?>
