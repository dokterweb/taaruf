<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Paket;
use App\Models\Member;
use Illuminate\Support\Str;
use App\Models\Member_paket;
use Illuminate\Http\Request;

class Member_paketController extends Controller
{
    public function index()
    {
        $member_pakets = Member_paket::with(['member', 'paket'])->get();
        return view('admin.member_pakets.index',compact('member_pakets'));
    }

    public function create()
    {
        $members = Member::all();
        $pakets = Paket::all();
        return view('admin.member_pakets.create',compact('pakets','members'));
    }

  
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'member_id'     => 'required|exists:members,id',
            'paket_id'      => 'required|exists:pakets,id',
            'status'        => 'required|in:pending,paid',
            'tanggalmulai'  => 'required|date',
            // 'tanggalakhir' JANGAN divalidasi dari request, kita hitung sendiri
        ]);

        // Ambil durasi paket (dalam BULAN)
        $paket  = Paket::findOrFail($validated['paket_id']);
        $durasi = (int) $paket->durasi; // asumsi: kolom 'durasi' = bulan

        // Hitung tanggal akhir:
        $mulai = Carbon::parse($validated['tanggalmulai'])->startOfDay();

        // Tidak overflow ke bulan berikutnya (misal 31 Jan + 1 bulan = 28/29 Feb)
        $akhir = $mulai->copy()->addMonthsNoOverflow($durasi);

        // Jika kebijakanmu INKLUSIF (contoh: mulai 1 Jan durasi 1 bulan berakhir 31 Jan),
        // aktifkan baris di bawah:
        // $akhir->subDay();

        // (Opsional) generate order_id jika tidak ada di form
        $orderId = 'MP-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));

        // Simpan
        Member_paket::create([
            'member_id'     => $validated['member_id'],
            'paket_id'      => $validated['paket_id'],
            'status'        => $validated['status'],
            'order_id'      => $orderId,
            'tanggalmulai'  => $mulai->toDateString(),
            'tanggalakhir'  => $akhir->toDateString(),
        ]);

        return redirect()
            ->route('member_pakets.index')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function edit(Member_paket $member_paket)
    {
        $members = Member::all();
        $pakets = Paket::all();
        return view('admin.member_pakets.edit', compact('member_paket','pakets','members'));
    }

    public function update(Request $request, Member_paket $member_paket)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'paket_id' => 'required|exists:pakets,id',
            'status' => 'required|in:pending,paid',
        ]);

        // Update data member_paket
        $member_paket->member_id = $request->input('member_id');
        $member_paket->paket_id = $request->input('paket_id');
        $member_paket->status = $request->input('status');
        $member_paket->save();

        // Redirect atau tampilkan pesan sukses setelah data diupdate
        return redirect()->route('admin.member_pakets.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Member_paket $member_paket)
    {
        // Hapus data dari tabel member_pakets
        $member_paket->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.member_pakets.index')->with('success', 'Data berhasil dihapus.');
    }

}
