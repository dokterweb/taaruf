<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member_paket extends Model
{
    use HasFactory, SoftDeletes;

    // Menentukan nama tabel jika tidak mengikuti konvensi
    protected $table = 'member_pakets';

    // Menentukan kolom yang bisa diisi mass-assignable
    protected $fillable = ['member_id', 'paket_id', 'status','order_id','tanggalmulai','tanggalakhir'];

    // Jika menggunakan timestamps, pastikan untuk mengatur kolom yang sesuai
    public $timestamps = true;

    // Definisikan relasi ke tabel members
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    // Definisikan relasi ke tabel pakets
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
}
