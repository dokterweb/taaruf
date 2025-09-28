<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=['user_id', 'tempat_lahir', 'tanggal_lahir', 'kelamin', 'no_hp', 'is_active'];

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
}
