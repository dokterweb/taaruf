<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MatchModel extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'matches';

    // Kolom yang boleh diisi melalui mass assignment
    protected $fillable = [
        'member_one_id',
        'member_two_id',
        'created_at',
        'updated_at',
    ];

     // Relasi ke member one
     public function memberOne()
     {
         return $this->belongsTo(Member::class, 'member_one_id');
     }
 
     // Relasi ke member two
     public function memberTwo()
     {
         return $this->belongsTo(Member::class, 'member_two_id');
     }
}
