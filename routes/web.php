<?php
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // return view('welcome');
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboardbootstrap');
})->middleware(['auth', 'verified'])->name('dashboard');

// dashboardbootstrap
Route::get('/dashboardbootstrap', function () {
    return view('dashboardbootstrap');
})->middleware(['auth'])->name('dashboardbootstrap');

// route ke master data produk
Route::resource('/produk', ProdukController::class)->middleware(['auth']);
Route::get('/produk/{id}/image', [ProdukController::class, 'image'])->name('produk.image');
Route::get('/produk/destroy/{id}', [App\Http\Controllers\ProdukController::class,'destroy'])->middleware(['auth']);

Route::get('/coa', [CoaController::class, 'index'])->name('coa.index');
Route::get('/coa/create', [CoaController::class, 'create'])->name('coa.create');
Route::post('/coa/store', [CoaController::class, 'store'])->name('coa.store');
Route::delete('/coa/destroy/{coa}', [CoaController::class, 'destroy'])->name('coa.destroy');

Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
Route::put('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::delete('/pegawai/destroy/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/transaksi/produk', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/riwayat', [TransaksiController::class, 'riwayat'])->name('transaksi.riwayat');
Route::get('/transaksi/{id}/struk', [TransaksiController::class, 'struk'])->name('transaksi.struk');

Route::get('/laporan/jurnal', [LaporanController::class, 'jurnalUmum'])->name('laporan.jurnal');
Route::get('/laporan/buku-besar', [LaporanController::class, 'bukuBesar'])->name('laporan.buku-besar');

require __DIR__.'/auth.php';
