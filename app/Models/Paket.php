<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paket extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=['nama_paket', 'biaya', 'durasi', 'gambar', 'keterangan'];
    
    public function members()
    {
      /*   return $this->belongsToMany(Member::class, 'member_pakets', 'paket_id', 'member_id')
                    ->withPivot('status')
                    ->withTimestamps(); */
        return $this->belongsToMany(Member::class, 'member_pakets', 'paket_id', 'member_id')
                    ->withPivot(['status', 'tanggalmulai', 'tanggalakhir'])
                    ->withTimestamps();
    }
}
