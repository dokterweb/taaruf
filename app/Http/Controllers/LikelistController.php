<?php

namespace App\Http\Controllers;
use App\Models\Member;
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

    public function likedetail($id)
    {
        // Mengambil data member berdasarkan ID
        $member = Member::with('user')->findOrFail($id);

        // Mengirim data member ke blade
        return view('front.views.likedetail', compact('member'));
    }
}
