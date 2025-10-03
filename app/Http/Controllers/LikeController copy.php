<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Like;
use App\Models\MatchModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GotLiked;
use App\Notifications\NewMatch;

class LikeController extends Controller
{
    // Handle like action
    public function like($id)
    {
        $me = Auth::user()->member; // Member yang sedang login
        $target = Member::findOrFail($id); // Target member yang di-like

        // Pastikan tidak bisa like diri sendiri
        if ($me->id === $target->id) {
            return back()->with('error', 'Tidak bisa menyukai diri sendiri!');
        }

        // Simpan like ke dalam tabel
        DB::transaction(function () use ($me, $target) {
            // Menyimpan like dari A ke B (liker_member_id adalah yang memberi like, liked_member_id adalah yang di-like)
            Like::updateOrCreate(
                ['liker_member_id' => $me->id, 'liked_member_id' => $target->id],
                ['status' => 'liked']
            );

            // Cek apakah B sudah like A (mutual)
            $reciprocalLike = Like::where('liker_member_id', $target->id)
                ->where('liked_member_id', $me->id)
                ->where('status', 'liked')
                ->exists();

            if ($reciprocalLike) {
                // Jika mutual like, buat match
                $this->createMatch($me, $target);

                // Kirim notifikasi match ke kedua member
                Notification::send([$me->user, $target->user], new NewMatch($me, $target));
            } else {
                // Kirim notifikasi ke target "You got a like"
                $target->user->notify(new GotLiked($me));
            }
        });

        return back()->with([
            'success' => 'Like terkirim!',
            'liked_name' => $target->user->name
        ]);
        // return back()->with('success', 'Like terkirim!');
    }

    // Handle dislike action
    public function dislike($id)
    {
        $me = Auth::user()->member; // Member yang sedang login
        $target = Member::findOrFail($id); // Target member yang di-dislike

        // Pastikan tidak bisa dislike diri sendiri
        if ($me->id === $target->id) {
            return back()->with('error', 'Tidak bisa membenci diri sendiri!');
        }

        // Simpan dislike ke dalam tabel
        Like::updateOrCreate(
            ['liker_member_id' => $me->id, 'liked_member_id' => $target->id],
            ['status' => 'disliked']
        );

        // Hapus match jika ada (jika sebelumnya ada match)
        MatchModel::where(function ($query) use ($me, $target) {
            $query->where('member_one_id', $me->id)
                  ->where('member_two_id', $target->id);
        })->orWhere(function ($query) use ($me, $target) {
            $query->where('member_one_id', $target->id)
                  ->where('member_two_id', $me->id);
        })->delete();

        return back()->with('success', 'Dislike terkirim!');
    }

    // Membuat match jika dua member sudah saling like
    private function createMatch(Member $me, Member $target)
    {
        // Tentukan urutan member supaya match tetap unik
        $memberOne = $me->id < $target->id ? $me->id : $target->id;
        $memberTwo = $me->id < $target->id ? $target->id : $me->id;

        // Simpan match ke database
        MatchModel::firstOrCreate([
            'member_one_id' => $memberOne,
            'member_two_id' => $memberTwo,
        ]);
    }
}