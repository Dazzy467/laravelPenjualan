<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Nota;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Logger\ConsoleLogger;

class KasirController extends Controller
{
    //
    // Nota baru untuk dibikin 
    protected $newNota;
    protected $penjualanInstance = [];

    public function dashboard()
    {
        $Barang = Barang::all();
        
        return view('Kasir.dashboard',['Barang' => $Barang]);
    }

    public function cekStokBarang()
    {
        $Barang = Barang::all();
        return view('Kasir.stokBarang',['Barang' => $Barang]);
    }

    public function buatTransaksi(Request $request)
    {
        
        if ($request->session()->has('newNota'))
            $request->session()->forget('newNota');

        if ($request->session()->has('penjualanInstance'))
            $request->session()->forget('penjualanInstance');

        $this->newNota = new Nota();
        
        if (Nota::all()->isEmpty())
        {
            $this->newNota->idNota = 1;
        }
        else {
            $maxID = $this->newNota->max('idNota');
            $this->newNota->idNota = $maxID + 1;
        }

        $this->newNota->idUser = Auth::user()->idUser;
        $this->newNota->tanggalPembelian = now();
        $request->session()->put('newNota',serialize($this->newNota));
            
        

        return response()->json(array('idNota' => $this->newNota->idNota),200);
    }

    public function tambahBarangKeTransaksi(Request $request)
    {

        $idBarang = $request->idBarang;
        $Barang = Barang::findOrFail($idBarang);
        $HargaSatuan = $Barang->hargaBarang;
        $JumlahBarang = $request->JumlahBarang;
        $SubTotal = $Barang->hargaBarang * $JumlahBarang;

        $penjualan = new Penjualan();
        $this->newNota = unserialize($request->session()->get('newNota'));
        $penjualan->idNota = $this->newNota->idNota;
        $penjualan->idBarang = $idBarang;

        $penjualan->jumlahBarang = $JumlahBarang;
        $penjualan->totalHarga = $SubTotal;

        // array_push($this->penjualanInstance,$penjualan);
        if ($request->session()->has('penjualanInstance'))
        {
            $this->penjualanInstance = $request->session()->get('penjualanInstance');
            $isKetemu = false; 

            
            foreach($this->penjualanInstance as $valP)
            {
                if ($valP->idBarang == $penjualan->idBarang)
                {
                    $valP->jumlahBarang += $penjualan->jumlahBarang;
                    $JumlahBarang = $valP->jumlahBarang;
                    $SubTotal = $Barang->hargaBarang * $JumlahBarang;
                    $valP->totalHarga = $SubTotal;
                    $isKetemu = true;
                }
                
            }
            if ($isKetemu == false)
            {
                $this->penjualanInstance[] = $penjualan;
            }
            
            $request->session()->put('penjualanInstance',$this->penjualanInstance);

            return response()->json(array('Barang' => $Barang,'JumlahBarang' => $JumlahBarang,'HargaSatuan' => $HargaSatuan,'SubTotal' => $SubTotal),200);

        }
        $this->penjualanInstance[] = $penjualan;
        $request->session()->put('penjualanInstance',$this->penjualanInstance);
        $this->penjualanInstance = [];
        return response()->json(array('Barang' => $Barang,'JumlahBarang' => $JumlahBarang,'HargaSatuan' => $HargaSatuan,'SubTotal' => $SubTotal),200);
        
    }

    public function hapusBarangTransaksi(Request $request)
    {
        $this->penjualanInstance = $request->session()->get('penjualanInstance');
        foreach($this->penjualanInstance as $key => $valP)
        {
            if ($valP->Barang->namaBarang == $request->namaBarang)
            {
                unset($this->penjualanInstance[$key]);
            }
        }

        $this->penjualanInstance = array_values($this->penjualanInstance);
        $request->session()->put('penjualanInstance',$this->penjualanInstance);
        return response()->json(array("instance"=> $this->penjualanInstance),200);
        
    }

    public function simpanTransaksi(Request $request)
    {
        if ($request->session()->has('newNota'))
        {
            $this->newNota = unserialize($request->session()->get('newNota')); 
            $this->newNota->save();
        }
        
        if ($request->session()->has('penjualanInstance'))
        {
            $this->penjualanInstance = [];
            $this->penjualanInstance = $request->session()->get('penjualanInstance');
            // dd($this->penjualanInstance);
            
            foreach($this->penjualanInstance as $penjualan)
            {
                $penjualan->save();
            }
        }
        $request->session()->forget('newNota');
        $request->session()->forget('penjualanInstance');
        
        return redirect()->route('kasir.show');
    }
}
