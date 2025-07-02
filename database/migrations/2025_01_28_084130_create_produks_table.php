<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk', 10)->unique();  // Menambah panjang kode_produk
            $table->string('nama_produk', 100);           // Menambah panjang nama produk
            $table->string('kategori', 50);
            $table->string('ukuran', 20);                 // Ukuran mungkin lebih baik menggunakan panjang yang lebih kecil
            $table->decimal('harga', 10, 2); // Harga dengan format desimal
            $table->integer('stok')->default(0);          // Menambahkan default value untuk stok
            $table->string('gambar')->nullable();
            $table->enum('status', ['ada', 'tidak ada'])->default('tidak ada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};