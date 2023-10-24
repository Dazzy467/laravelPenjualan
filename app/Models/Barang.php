<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';

    protected $fillable = [
        'namaBarang',
        'stokBarang',
        'hargaBarang',
        'idSupplier'
    ];

    public function itemSuplai()
    {
        return $this->belongsTo(ItemSuplai::class,'idBarang');
    }
}
