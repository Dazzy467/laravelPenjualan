<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'nota';

    protected $fillable = [
        'idUser',
        'tanggalPembelian'
    ];

    public function User()
    {
        return $this->belongsTo(User::class,'idUser');
    }

    public function Penjualan()
    {
        return $this->hasMany(Penjualan::class,'idNota');
    }
}
