<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePaketRequest;
use App\Http\Requests\UpdatePaketRequest;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        return view('admin.pakets.index',compact('pakets'));
    }

    public function create()
    {
        return view('admin.pakets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaketRequest $request)
{
    DB::beginTransaction();
    try {
        $validated = $request->validated();

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('gambars'), $fileName);
            $gambarPath = 'gambars/' . $fileName;
        }

        Paket::create([
            'nama_paket' => $validated['nama_paket'],
            'biaya'      => $validated['biaya'],
            'durasi'     => $validated['durasi'],
            'gambar'     => $gambarPath,
            'keterangan' => $validated['keterangan'],
        ]);

        DB::commit();
        return redirect()->route('pakets.index')->with('success', 'Data Paket berhasil disimpan!');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->route('pakets.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        return view('admin.pakets.show', compact('paket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        return view('admin.pakets.edit',compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaketRequest $request, Paket $paket)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
    
            $gambarPath = $paket->gambar; // default gunakan gambar lama
    
            if ($request->hasFile('gambar')) {
                // Hapus file lama kalau ada
                if ($paket->gambar && file_exists(public_path($paket->gambar))) {
                    unlink(public_path($paket->gambar));
                }
    
                // Upload file baru
                $file = $request->file('gambar');
                $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('gambars'), $fileName);
                $gambarPath = 'gambars/' . $fileName;
            }
    
            // Update data paket
            $paket->update([
                'nama_paket' => $validated['nama_paket'],
                'biaya'      => $validated['biaya'],
                'durasi'     => $validated['durasi'],
                'gambar'     => $gambarPath,
                'keterangan' => $validated['keterangan'],
            ]);
    
            DB::commit();
            return redirect()->route('pakets.index')->with('success', 'Data Paket berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pakets.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('pakets.index')->with('success', 'Data berhasil dihapus.');
    }

}
