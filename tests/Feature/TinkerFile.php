<?php
$nota = new Nota();
$nota->idNota = 2;
$nota->idUser = 2;
$nota->tanggalPembelian = now();

$penjualan = new Penjualan();
$penjualan->idBarang = 1;
$penjualan->idNota = 1;
$penjualan->jumlahBarang = 2;
$penjualan->totalHarga = 30000;

$penjualan->Barang;
?>
