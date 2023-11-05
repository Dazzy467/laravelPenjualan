<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'barang';
    protected $primaryKey = 'IdBarang';
    protected $fillable = [
        'namaBarang',
        'stokBarang',
        'hargaBarang',
    ];

    public function itemSuplai()
    {
        return $this->belongsTo(ItemSuplai::class,'idBarang','idBarang');
    }

    public function Penjualan()
    {
        return $this->belongsTo(Penjualan::class,'idBarang','idBarang');
    }
}
