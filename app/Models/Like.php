<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;

    // Tambahkan kolom-kolom yang boleh diisi melalui mass assignment
    protected $fillable = [
        'liker_member_id', 
        'liked_member_id', 
        'status'
    ];

      // Relasi jika dibutuhkan untuk Eager Loading
      public function liker() {
        return $this->belongsTo(Member::class, 'liker_member_id');
    }

    public function liked() {
        return $this->belongsTo(Member::class, 'liked_member_id');
    }
}
