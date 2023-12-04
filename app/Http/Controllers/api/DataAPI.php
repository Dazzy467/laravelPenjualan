<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\ItemSuplai;
use App\Models\Penjualan;
use App\Models\User;
use App\Models\Nota;

class DataAPI extends Controller
{
    public function getItemSuplai()
    {
        $itemSuplai = ItemSuplai::all();
        
        return response()->json(array('ItemSuplai' => $itemSuplai),200);
    }

    public function getNota()
    {
        $nota = Nota::all();
        
        return response()->json(array('Nota' => $nota),200);
    }
}
