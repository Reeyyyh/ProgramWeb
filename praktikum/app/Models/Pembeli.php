<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $fillable = ['nama', 'email', 'password'];

    public function tiket()
    {
        return $this->hasMany(Tiket::class, 'pembeli_id', 'id');
    }
}
