<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('produk.view', ['produk' => $produk]);
    }

    public function create()
    {
        $produkModel = new \App\Models\Produk();
        $kodeproduk = $produkModel->getKodeProduk();
        return view('produk.create', ['kode_produk' => $kodeproduk]);
    }

    public function store(StoreProdukRequest $request)
    {
        try {
            // Menghapus simbol 'Rp.' dan titik ribuan
            $harga = str_replace(['Rp.', '.'], '', $request->harga);
            $harga = (float) $harga;

            $imageData = null;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');

                // Validate image
                $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $extension = strtolower($file->getClientOriginalExtension());

                if (!in_array($extension, $validExtensions)) {
                    return back()->with('error', 'Format file harus jpg, jpeg, png, atau gif');
                }

                // Get image binary data
                $imageData = file_get_contents($file->getRealPath());
            }

            // Create product
            Produk::create([
                'kode_produk' => $request->kode_produk,
                'nama_produk' => $request->nama_produk,
                'kategori' => $request->kategori,
                'harga' => $harga,
                'gambar' => $imageData, // simpan binary data langsung
            ]);

            return redirect()->route('produk.index')
                            ->with('success', 'Data Berhasil di Input');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function image($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar) {
            $finfo = finfo_open();
            $mimeType = finfo_buffer($finfo, $produk->gambar, FILEINFO_MIME_TYPE);

            return response($produk->gambar)
                ->header('Content-Type', $mimeType);
        }

        abort(404);
    }

    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        try {
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                
                $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $extension = strtolower($file->getClientOriginalExtension());
                
                if (!in_array($extension, $validExtensions)) {
                    return back()->with('error', 'Format file harus jpg, jpeg, png, atau gif');
                }

                $fileContent = file_get_contents($file->getRealPath());

            } else {
                $fileContent = $produk->gambar;
            }

            $harga = str_replace(['Rp.', '.', ' '], '', $request->harga);
            $harga = str_replace(',', '.', $harga);
            $harga = (float) $harga;

            $produk->update([
                'kode_produk' => $request->kode_produk,
                'nama_produk' => $request->nama_produk,
                'kategori' => $request->kategori,
                'harga' => $harga,
                'gambar' => $fileContent,
            ]);

            return redirect()->route('produk.index')
                        ->with('success', 'Data Berhasil di Update');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);

            if ($produk->gambar) {
                Storage::disk('public')->delete('produk/' . $produk->gambar);
            }

            $produk->delete();

            return redirect()->route('produk.index')
                           ->with('success', 'Data Berhasil di Hapus');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
}
}
}