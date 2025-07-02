<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawai.view', compact('pegawai'));
    }

    public function create(pegawai $pegawai)
    {
        return view('pegawai.create', compact('pegawai'));
    }

    public function store(StorePegawaiRequest $request)
    {
        Pegawai::create([
            'nama_pegawai' => $request->nama_pegawai,
            'nomor_pegawai' => $request->nomor_pegawai,
            'email_pegawai' => $request->email_pegawai,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }
    
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $pegawai->update([
            'nama_pegawai' => $request->nama_pegawai,
            'nomor_pegawai' => $request->nomor_pegawai,
            'email_pegawai' => $request->email_pegawai,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai)
    {
        try {
            $pegawai->delete();
            return redirect()->route('pegawai.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
