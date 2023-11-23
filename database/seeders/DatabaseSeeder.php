<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
            'role' => 0
        ]);

        User::create([
            'name' => 'David Yusuf',
            'email' => 'david@mail.com',
            'password' => Hash::make('12345'),
            'role' => 1
        ]);

        Barang::create([
            'namaBarang' => 'PVC',
            'stokBarang' => 0,
            'hargaBarang' => 15000,
        ]);

        Barang::create([
            'namaBarang' => 'Asbes',
            'stokBarang' => 0,
            'hargaBarang' => 20000,
        ]);

        Barang::create([
            'namaBarang' => 'Semen 3 roda',
            'stokBarang' => 0,
            'hargaBarang' => 50000,
        ]);

        Supplier::create([
            'nama' => 'Agus',
            'alamat' => 'Sleman',
            'noTelp' => '0812345678'
        ]);

        Supplier::create([
            'nama' => 'Bagas',
            'alamat' => 'Bantul',
            'noTelp' => '081444444'
        ]);
    }
}
