<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSuplai extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'itemsuplai';
    protected $primaryKey = 'idItemSuplai';
    protected $fillable = [

        'idSupplier',
        'idBarang',
        'jumlahBarang',
        'tanggalMasuk',
        'totalKulakan'
    ];

    public function Barang()
    {
        return $this->hasOne(Barang::class,'idBarang','idBarang');
    }

    public function Supplier()
    {
        return $this->hasOne(Supplier::class,'idSupplier','idSupplier');
    }
}
