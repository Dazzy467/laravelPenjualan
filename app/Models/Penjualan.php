<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    public $timestamps = false;
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
    
    public function Barang()
    {
        return $this->hasOne(Barang::class,'idBarang');
    }
}
