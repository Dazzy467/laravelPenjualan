<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';

    protected $fillable = [
        'nama',
        'alamat',
        'noTelp',
    ];

    public function Barang()
    {
        return $this->hasMany(Barang::class,'idSupplier');
    }
}
