<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Member;
use App\Models\Member_paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $me = Auth::user()->member;  // member milik user login
        $meId = $me->id ?? 0;
        $gender = $me->kelamin;  // Ambil jenis kelamin member yang login
    
        // Paket yang sedang AKTIF dimiliki oleh member yang login (exclude)
        $myActivePaketIds = Member_paket::query()
            ->where('member_id', $meId)
            ->where('status', 'paid')
            ->whereDate('tanggalmulai', '<=', now())
            ->whereDate('tanggalakhir', '>=', now())
            ->pluck('paket_id')
            ->unique();
    
        // Ambil paket lain (exclude paket yang sedang dimiliki)
        $pakets = Paket::query()
            ->whereNotIn('id', $myActivePaketIds)  // Hanya ambil paket selain yang sudah dimiliki
            ->orderBy('id')
            ->get(['id', 'nama_paket', 'durasi', 'biaya']);

    
        // Untuk setiap paket, ambil 20 member acak yang aktif di paket tsb dan filter jenis kelamin
        foreach ($pakets as $paket) {
            $paket->random_members = $paket->members()
                ->wherePivot('status', 'paid')
                ->wherePivot('tanggalmulai', '<=', now())
                ->wherePivot('tanggalakhir', '>=', now())
                ->where('members.is_active', '1')
                ->where('members.id', '<>', $meId)  // Jangan tampilkan member yang login
                ->where('members.kelamin', $gender == 'pria' ? 'wanita' : 'pria')  // Filter berdasarkan kelamin
                ->with('user')
                ->inRandomOrder()  // Ambil secara acak
                ->limit(20)  // Batasi hanya 20 member
                ->get([
                    'members.id',
                    'members.user_id',
                    'members.kelamin',
                    'members.tempat_tinggal',
                    'members.tanggal_lahir',
                ]);
        }
    
        return view('front.views.wishlist', compact('pakets'));
    }
    
    

    public function wishlistex()
    {
        return view('front.views.wishlistex');
    }

}
