<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $fillable = ['nama_tiket', 'harga', 'pembeli_id'];
    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'pembeli_id', 'id');
    }
}
