<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Http\Requests\StoreCoaRequest;

class CoaController extends Controller
{
    public function index()
    {
        $coa = Coa::all();
        return view('coa.view', compact('coa'));
    }

    public function create()
    {
        return view('coa.create');
    }

    public function store(StoreCoaRequest $request)
    {
        try {
            $request->validate([
                'nama_akun'  => 'required|string',
                'nomor_akun' => 'required|integer',
                'header_akun' => 'required|string',
            ]);

            Coa::create([
                'nama_akun' => $request->nama_akun,                
                'nomor_akun' => $request->nomor_akun,                
                'header_akun' => $request->header_akun,
            ]);

            return redirect()->route('coa.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Coa $coa)
    {
        try {
            $request->validate([
                'nama_akun'  => 'required|string|max:255',
                'nomor_akun' => 'required|string|max:50|unique:coas,nomor_akun,' . $coa->id,
                'header_akun' => 'nullable|string|max:255',
            ]);

            $coa->update($request->only(['nama_akun', 'nomor_akun', 'header_akun']));

            return redirect()->route('coa.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Coa $coa)
    {
        try {
            $coa->delete();
            return redirect()->route('coa.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
