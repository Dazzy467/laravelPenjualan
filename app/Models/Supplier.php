<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'supplier';
    protected $primaryKey = 'IdSupplier';

    protected $fillable = [
        'nama',
        'alamat',
        'noTelp',
    ];

    public function ItemSuplai()
    {
        return $this->hasMany(ItemSuplai::class,'idSupplier','idSupplier');
    }
}
