<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'members';  // Pastikan tabelnya benar
    
    protected $fillable=['user_id', 'tempat_lahir', 'tanggal_lahir', 'kelamin', 'no_hp', 'tempat_tinggal', 'pendidikan', 'email_kedua','karakter', 'karakter_pasangan', 'hafalan_surat', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pakets()
    {
        return $this->belongsToMany(Paket::class, 'member_pakets', 'member_id', 'paket_id')
                    ->withPivot('status')        // kolom ekstra di pivot
                    ->withTimestamps();          // created_at & updated_at di pivot
    }

   
    public function likesGiven()  { 
        return $this->hasMany(Like::class, 'liker_member_id'); 
    }

    public function likesReceived() {
        return $this->hasMany(Like::class, 'liked_member_id'); 
    }

    public function matchesAsOne()
    {
        return $this->hasMany(MatchModel::class, 'member_one_id');
    }
    
    public function matchesAsTwo()
    {
        return $this->hasMany(MatchModel::class, 'member_two_id');
    }
    
    public function matches()
    {
        return $this->matchesAsOne()->union($this->matchesAsTwo());
    }
}
