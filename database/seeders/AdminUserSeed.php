<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bikin user admin bila tidak ada user samsek
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
            'role' => 0
        ]);
    }
}
