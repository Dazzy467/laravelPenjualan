<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Exception;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    //
    public function dashboard()
    {
        // Logic for the admin dashboard
        $barang = Barang::all();
        $penjualan = Penjualan::all();
        return view('Gudang/dashboard',['produk' => $barang,'penjualan' => $penjualan]);
    }

    public function kelolaBarang()
    {
        $barang = Barang::all();
        return view('Gudang.kelolaBarang',['Barang'=> $barang]);
    }

    public function editBarang_form($idBarang)
    {
        $barang = Barang::findOrFail($idBarang);
        return view('Gudang.editBarang',['Barang' => $barang]);
    }

    public function editBarang(Request $request)
    {
        $barang = Barang::find($request->input('idBarang'));
        $barang->namaBarang = $request->input('namaBarang');
        $barang->stokBarang = $request->input('stokBarang');
        $barang->hargaBarang = $request->input('hargaBarang');
        $barang->save();
        return redirect()->route('gudang.kelolabarang')->with('success', 'Barang berhasil diedit');

    }

    public function addBarang_form()
    {
        return view('Gudang.addBarang');
    }

    public function addBarang(Request $request)
    {
        Barang::create([
            'namaBarang' => $request->input('namaBarang'),
            'stokBarang' => $request->input('stokBarang'),
            'hargaBarang' => $request->input('hargaBarang')
        ]);
        return redirect()->route('gudang.kelolabarang')->with('success', 'Barang berhasil ditambahkan!');

    }

    public function deleteBarang($idBarang)
    {
        try{
            $barang = Barang::findOrFail($idBarang);
            $barang->delete();
            return redirect()->route('gudang.kelolabarang')->with('success', 'Barang berhasil terhapus!');
        }
        catch(Exception $e)
        {
            return redirect()->route('gudang.kelolabarang')->with('error', 'Record barang tidak ditemukan !');
        }
    }
}
