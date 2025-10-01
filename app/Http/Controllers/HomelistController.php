<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\Member_paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomelistController extends Controller
{
    public function homelist()
    {
        $user   = Auth::user();
        $member = $user->member;

        if (!$member) {
            return view('front.views.homelist', [
                'cards' => collect(),
                'myPaketId' => null,
            ])->with('error', 'Profil member belum lengkap.');
        }

        // Ambil paket_id aktif user ini (prioritaskan status paid, fallback ke pending terbaru)
        $myPaketRow = Member_paket::where('member_id', $member->id)
            ->orderByRaw("CASE WHEN status='paid' THEN 1 WHEN status='pending' THEN 2 ELSE 3 END")
            ->orderByDesc('id')
            ->first();

        if (!$myPaketRow) {
            return view('front.views.homelist', [
                'cards' => collect(),
                'myPaketId' => null,
            ])->with('error', 'Anda belum memiliki paket.');
        }

        $myPaketId = $myPaketRow->paket_id;

        // Ambil daftar member_id lain yang punya paket yang sama
        $memberIds = Member_paket::where('paket_id', $myPaketId)
            ->where('member_id', '!=', $member->id)   // exclude diri sendiri
            ->pluck('member_id')
            ->unique();

            // tentukan kelamin lawan
        $targetKelamin = $member->kelamin === 'pria' ? 'wanita' : 'pria';

        // Ambil profil mereka + user (avatar, name) sekaligus (eager load)
        $cards = Member::with('user')
            ->whereIn('id', $memberIds)
            ->where('kelamin', $targetKelamin) // filter lawan jenis
            ->orderByDesc('updated_at')
            ->simplePaginate(12); // pagination opsional

        return view('front.views.homelist', compact('cards','myPaketId'));
    }
}
