<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = [
        'idNota',
        'jumlahBarang',
        'totalHarga',
        'idBarang'
    ];

    public function Nota()
    {
        return $this->belongsTo(Nota::class,'idNota');
    }
}
