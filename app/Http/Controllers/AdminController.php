<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'role' => ['required','integer','in:0,1']
        ]);
    }

    public function manageuser()
    {
        $user = User::all();
        return view('admin.manageuser',['user' => $user]);
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
            'role' => ['required','integer','in:0,1']
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
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required','integer','in:0,1']
        ]);
        

        // Create a new user
        $user = User::find($request->input('id'));
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
