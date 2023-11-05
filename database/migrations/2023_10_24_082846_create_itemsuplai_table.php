<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('itemsuplai', function (Blueprint $table) {
            $table->bigIncrements('idItemSuplai');
            $table->foreignId('idSupplier')->constrained('supplier','idSupplier');
            $table->foreignId('idBarang')->constrained('barang','idBarang');
            $table->integer('jumlahBarang');
            $table->date('tanggalMasuk');
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itemsuplai');
    }
};
