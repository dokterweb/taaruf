<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\Like;
use App\Models\MatchModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikelistController extends Controller
{
   public function index()
    {
        // Mendapatkan member yang login
        $me = Auth::user()->member;

        // Mengambil data Matches (saling like)
        $matches = $me->matches()->get();

        // Mengambil data Likes (yang memberikan like)
        $likes = $me->likesReceived()->where('status', 'liked')->get();

        // Menghilangkan likes yang sudah ada di matches
        $likedMemberIds = $matches->pluck('member_one_id')->merge($matches->pluck('member_two_id'))->unique();
        $likes = $likes->filter(function ($like) use ($likedMemberIds) {
            return !$likedMemberIds->contains($like->liker_member_id);
        });

        // Mengirim data matches dan likes ke view
        return view('front.views.likelists', compact('matches', 'likes'));
    }

/*     public function likedetail($id)
    {
        // Mengambil data member berdasarkan ID
        $member = Member::with('user')->findOrFail($id);

        // Mengirim data member ke blade
        return view('front.views.likedetail', compact('member'));
    } */

    public function dislike_detail($id)
    {
        $me = Auth::user()->member;  // Mendapatkan member yang login
        $target = Member::findOrFail($id);  // Mendapatkan member yang di-dislike

        // Pastikan tidak bisa dislike diri sendiri
        if ($me->id === $target->id) {
            return back()->with('error', 'Tidak bisa membenci diri sendiri!');
        }

        // Ubah status Like menjadi 'disliked'
        Like::where('liker_member_id', $me->id)
            ->where('liked_member_id', $target->id)
            ->update(['status' => 'disliked']);

        // Hapus match jika ada
        MatchModel::where(function ($query) use ($me, $target) {
            $query->where('member_one_id', $me->id)
                  ->where('member_two_id', $target->id);
        })->orWhere(function ($query) use ($me, $target) {
            $query->where('member_one_id', $target->id)
                  ->where('member_two_id', $me->id);
        })->delete();

        return back()->with('success', 'Dislike berhasil dilakukan.');
    }


    public function likedetail($id)
    {
        $member = Member::with('user')->findOrFail($id);
        $me = Auth::user()->member;

        // Cek apakah sudah match
        $alreadyMatched = MatchModel::where(function ($query) use ($me, $member) {
            $query->where('member_one_id', $me->id)
                ->where('member_two_id', $member->id);
        })->orWhere(function ($query) use ($me, $member) {
            $query->where('member_one_id', $member->id)
                ->where('member_two_id', $me->id);
        })->exists();

        return view('front.views.likedetail', compact('member', 'alreadyMatched'));
    }
}
