<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Coa extends Model
{
    use HasFactory;

    protected $table = 'coa';
    protected $primaryKey = "id";

    protected $fillable = [
        'nama_akun',
        'nomor_akun',
        'header_akun',        
    ];
}