<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Member;
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
        return view('admin.member_pakets.create', compact('pakets','members'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'paket_id' => 'required|exists:pakets,id',
            'status' => 'required|in:pending,paid',
        ]);

        // Simpan data ke dalam tabel member_pakets
        $memberPaket = new Member_paket();
        $memberPaket->member_id = $request->input('member_id');
        $memberPaket->paket_id = $request->input('paket_id');
        $memberPaket->status = $request->input('status');
        $memberPaket->save();

        // Redirect atau tampilkan pesan sukses setelah data disimpan
        return redirect()->route('admin.member_pakets.index')->with('success', 'Data berhasil disimpan.');
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
