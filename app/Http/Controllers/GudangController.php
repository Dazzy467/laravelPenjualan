<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\ItemSuplai;
use App\Models\Penjualan;
use App\Models\Supplier;
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
        $supplier = Supplier::all();
        $itemSuplai = ItemSuplai::all();
        return view('Gudang/dashboard',['produk' => $barang,'penjualan' => $penjualan,'supplier' => $supplier,'itemSuplai' => $itemSuplai]);
    }

    public function catatSuplai(Request $request)
    {
        $itemSuplai = new ItemSuplai();
        $itemSuplai->idSupplier = $request->idSupplier;
        $itemSuplai->idBarang = $request->idBarang;
        $itemSuplai->jumlahBarang = $request->JumlahBarang;
        $itemSuplai->tanggalMasuk = now();
        $itemSuplai->totalKulakan = $request->totalKulakan;
        $itemSuplai->save();


        $itemSuplai = ItemSuplai::find($itemSuplai->idItemSuplai);
        return response()->json(array('no' => ItemSuplai::count(),'namaSupplier' => $itemSuplai->Supplier->nama,'namaBarang' => $itemSuplai->Barang->namaBarang,'jumlahBarang' => $itemSuplai->jumlahBarang,'tanggalMasuk' => $itemSuplai->tanggalMasuk,'totalKulakan' => $itemSuplai->totalKulakan),200);
    }

    public function kelolaBarang()
    {
        $barang = Barang::all();
        return view('Gudang.kelolaBarang',['Barang'=> $barang]);
    }

    public function kelolaSupplier()
    {
        $supplier = Supplier::all();
        return view('Gudang.kelolaSupplier',['Supplier' => $supplier]);
    }

    public function editBarang_form($idBarang)
    {
        $barang = Barang::findOrFail($idBarang);
        return view('Gudang.editBarang',['Barang' => $barang]);
    }

    public function editBarang(Request $request)
    {
        $barang = Barang::findOrFail($request->input('idBarang'));
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


    public function addSupplier_form()
    {
        return view('Gudang.addSupplier');
    }

    public function addSupplier(Request $request)
    {
        Supplier::create([
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'noTelp' => $request->input('noTelp')
        ]);
        return redirect()->route('gudang.kelolasupplier')->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function editSupplier_form($idSupplier)
    {
        $supplier = Supplier::findOrFail($idSupplier);
        return view('Gudang.editSupplier',['Supplier' => $supplier]);
    }

    public function editSupplier(Request $request)
    {
        $supplier = Supplier::findOrFail($request->input('idSupplier'));
        $supplier->nama = $request->input('nama');
        $supplier->alamat = $request->input('alamat');
        $supplier->noTelp = $request->input('noTelp');
        $supplier->save();

        return redirect()->route('gudang.kelolasupplier')->with('success', 'Supplier berhasil diedit!');
    }

    public function deleteSupplier($idSupplier)
    {
        try{
            $supplier = Supplier::findOrFail($idSupplier);
            $supplier->delete();
            return redirect()->route('gudang.kelolasupplier')->with('success', 'Supplier berhasil terhapus!');
        }
        catch(Exception $e)
        {
            return redirect()->route('gudang.kelolasupplier')->with('error', 'Record supplier tidak ditemukan !');
        }
    }
}
