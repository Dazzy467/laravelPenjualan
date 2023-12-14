<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\ItemSuplai;
use App\Models\Penjualan;
use App\Models\User;
use App\Models\Nota;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Khill\Lavacharts\Lavacharts;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class AdminController extends Controller
{
    //
    public function dashboard()
    {
        // Logic for the admin dashboard
        $user = User::all();
        $barang = Barang::all();
        $penjualan = Penjualan::all();
        return view('admin/dashboard',['user' => $user,'produk' => $barang,'penjualan' => $penjualan]);
    }
    
     protected function validator(array $data)
     {
         return Validator::make($data, [
             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'password' => ['required', 'string', 'confirmed'],
             'role' => ['required', 'integer', 'in:0,1']
         ]);
     }
    public function manageuser()
    {
        $user = User::all();
        return view('admin.manageuser',['user' => $user]);
    }

    public function grafikPenjualan()
    {
        $lava = new Lavacharts; 

        // Monthly Chart
        $penjualanBulanIni = $lava->DataTable();
        $penjualanBulanIni->addStringColumn('Barang')
            ->addNumberColumn('Jumlah Terjual');
        // Ambil data penjualan bulan ini
        $dataPenjualanBulanIni = DB::table('penjualan')
            ->join('nota', 'penjualan.idNota', '=', 'nota.idNota')
            ->join('barang', 'penjualan.idBarang', '=', 'barang.idBarang')
            ->whereMonth('nota.tanggalPembelian', date('m'))
            ->select('barang.namaBarang', DB::raw('SUM(penjualan.jumlahBarang) as total'))
            ->groupBy('barang.namaBarang')
            ->get();

        // Tambahkan data penjualan bulan ini ke tabel
        foreach ($dataPenjualanBulanIni as $data) {
            $penjualanBulanIni->addRow([$data->namaBarang, $data->total]);
        }

        $lava->ColumnChart('Penjualan Bulan Ini', $penjualanBulanIni, [
            'title' => 'Penjualan bulan ini',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'responsive' => true,
            'events' => [
                'ready' => 'function () {
                    if (!window.chartResized) {
                        setTimeout(function () {
                            window.dispatchEvent(new Event("resize"));
                            window.chartResized = true;
                        }, 200);
                    }
                }'
            ]
        ]);

        // Yearly Chart
        $penjualanTahunIni = $lava->DataTable();
        $penjualanTahunIni->addStringColumn('Barang')
            ->addNumberColumn('Jumlah Terjual');
        // Ambil data penjualan tahun ini
        $dataPenjualanTahunIni = DB::table('penjualan')
            ->join('nota', 'penjualan.idNota', '=', 'nota.idNota')
            ->join('barang', 'penjualan.idBarang', '=', 'barang.idBarang')
            ->whereYear('nota.tanggalPembelian', date('Y'))
            ->select('barang.namaBarang', DB::raw('SUM(penjualan.jumlahBarang) as total'))
            ->groupBy('barang.namaBarang')
            ->get();

        // Tambahkan data penjualan tahun ini ke tabel
        foreach ($dataPenjualanTahunIni as $data) {
            $penjualanTahunIni->addRow([$data->namaBarang, $data->total]);
        }

        $lava->ColumnChart('Penjualan Tahun Ini', $penjualanTahunIni, [
            'title' => 'Penjualan tahun ini',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'responsive' => true,
            'events' => [
                'ready' => 'function () {
                    if (!window.chartResized) {
                        setTimeout(function () {
                            window.dispatchEvent(new Event("resize"));
                            window.chartResized = true;
                        }, 200);
                    }
                }'
            ]
        ]);

        return view('admin.grafikPenjualan', ['lava' => $lava]);
    }
    public function pendapatan()
    {
        $nota = Nota::all();
        $supply = ItemSuplai::all();
        return view('admin.pendapatan',['Nota' => $nota,'Suplai' => $supply]);
    }


    public function adduser_form()
    {
        return view('admin/adduser');
    }

    public function edituser_form($userID)
    {
        $user = User::findOrFail($userID);

        if ($user->idUser == 1)
        {
            return redirect()->route('admin.manageuser')->with('error', 'Akun admin tidak boleh diedit!');

        }
        return view('admin/edituser',['user' => $user]);
    }

    public function adduser(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'role' => ['required','integer','in:0,1,2']
        ]);
        

        // Create a new user
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->role = $data['role'];
        $user->save();

        return redirect()->route('admin.manageuser')->with('success', 'User berhasil ditambahkan !');
    }

    public function edituser(Request $request)
    {

        $idUser = $request->input('id');
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($idUser,'idUser')
            ],
            'role' => ['required','integer','in:0,1,2']
        ]);
        
        
        // Edit user
        $user = User::find($idUser);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->save();

        return redirect()->route('admin.manageuser')->with('success', 'User berhasil diedit');
    }


    public function deleteUser($userID)
    {
        try{
            $user = User::findOrFail($userID);

            if ($user->idUser == 1)
            {
                return redirect()->route('admin.manageuser')->with('error', 'Akun admin tidak bisa dihapus!');
            }

            $user->delete();
            return redirect()->route('admin.manageuser')->with('success', 'User berhasil terhapus!');
        }
        catch(Exception $e)
        {
            return redirect()->route('admin.manageuser')->with('error', 'Record user tidak ditemukan !');
        }
    }
}
