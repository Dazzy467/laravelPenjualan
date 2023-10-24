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
        //
        DB::unprepared('
            CREATE TRIGGER tr_Update_Stok_Barang AFTER INSERT ON `itemsuplai`
            FOR EACH ROW
            BEGIN
                UPDATE barang SET stokBarang = stokBarang + NEW.jumlahBarang WHERE idBarang = NEW.idBarang;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP TRIGGER `tr_Update_Stok_Barang`');
    }
};
