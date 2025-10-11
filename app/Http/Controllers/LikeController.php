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
    public function like($id)
    {
        $me = Auth::user()->member;
        $target = Member::findOrFail($id);
    
        if ($me->id === $target->id) {
            return back()->with('error', 'Tidak bisa menyukai diri sendiri!');
        }
    
        $isMatch = false; // <<< Flag
    
        DB::transaction(function () use ($me, $target, &$isMatch) {
            Like::updateOrCreate(
                ['liker_member_id' => $me->id, 'liked_member_id' => $target->id],
                ['status' => 'liked']
            );
    
            $reciprocalLike = Like::where('liker_member_id', $target->id)
                ->where('liked_member_id', $me->id)
                ->where('status', 'liked')
                ->exists();
    
            if ($reciprocalLike) {
                $this->createMatch($me, $target);
                Notification::send([$me->user, $target->user], new NewMatch($me, $target));
                $isMatch = true; // <<< Tandai match
            } else {
                $target->user->notify(new GotLiked($me));
            }
        });
    
        // Return berdasarkan hasil
        if ($isMatch) {
            return back()->with([
                'matched_name' => $target->user->name
            ]);
        }
    
        // Hanya like saja
        return back()->with([
            'liked_name' => $target->user->name
        ]);
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

        // return back()->with('success', 'Dislike terkirim!');
        return back()->with([
            'disliked_name' => $target->user->name,
        ]);
        
    }

    // Membuat match jika dua member sudah saling like
/*     private function createMatch(Member $me, Member $target)
    {
        // Tentukan urutan member supaya match tetap unik
        $memberOne = $me->id < $target->id ? $me->id : $target->id;
        $memberTwo = $me->id < $target->id ? $target->id : $me->id;

        // Simpan match ke database
        MatchModel::firstOrCreate([
            'member_one_id' => $memberOne,
            'member_two_id' => $memberTwo,
        ]);
    } */

    private function createMatch(Member $me, Member $target)
    {
        // Pastikan kedua member sudah saling like
        $isLikedByTarget = Like::where('liker_member_id', $target->id)
                            ->where('liked_member_id', $me->id)
                            ->where('status', 'liked')
                            ->exists(); // Mengecek apakah target menyukai member ini

        $isLikedByMe = Like::where('liker_member_id', $me->id)
                            ->where('liked_member_id', $target->id)
                            ->where('status', 'liked')
                            ->exists(); // Mengecek apakah member ini menyukai target

        if ($isLikedByMe && $isLikedByTarget) {
            // Tentukan urutan member supaya match tetap unik
            $memberOne = $me->id < $target->id ? $me->id : $target->id;
            $memberTwo = $me->id < $target->id ? $target->id : $me->id;

            // Simpan match ke database jika kedua member saling suka
            MatchModel::firstOrCreate([
                'member_one_id' => $memberOne,
                'member_two_id' => $memberTwo,
            ]);
        }
    }

}