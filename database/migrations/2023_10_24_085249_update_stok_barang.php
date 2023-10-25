<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update stok barang saat disuplai
        DB::unprepared('
            CREATE TRIGGER tr_Update_Stok_Barang_Supplied AFTER INSERT ON `itemsuplai`
            FOR EACH ROW
            BEGIN
                UPDATE barang SET stokBarang = stokBarang + NEW.jumlahBarang WHERE idBarang = NEW.idBarang;
            END
        ');
        
        // Update stok barang saat nota dibuat
        DB::unprepared('
        CREATE TRIGGER tr_Update_Stok_Barang_Terjual AFTER INSERT ON `penjualan`
        FOR EACH ROW
        BEGIN
            UPDATE barang SET stokBarang = stokBarang - NEW.jumlahBarang WHERE idBarang = NEW.idBarang;
        END
    ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP TRIGGER `tr_Update_Stok_Barang_Supplied`');
        DB::unprepared('DROP TRIGGER `tr_Update_Stok_Barang_Terjual`');
    }
};
