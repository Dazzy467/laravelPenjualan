@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar-admin')
@endsection
@section('content')
@vite(['resources/js/datatableFilter.js'])
<div>
    <!-- He who is contented is rich. - Laozi -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="card bg-white shadow">
                <div class="text-center pt-2" style="font-weight: 600;">
                    <h3>Pendapatan</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif

                    <div class="card" style="background-color: #D9D9D9">
                        <div class="p-2">
                            <span style="font-size: 18px">Filter laporan</span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex p-2">
                                <div class="col-md-4">
                                    <label class="row">Mulai tanggal</label>
                                    <input class="row" type="date" id="StartDate" name="StartDate" placeholder="Tanggal">
                                </div>
                                <div class="col-md-4">
                                    <label class="row">Sampai tanggal</label>
                                    <input class="row" type="date" id="EndDate" name="EndDate" placeholder="Tanggal">
                                </div>
                                <div class="col-md-4">
                                    <label class="row">Kategori</label>
                                    <select class="row" id="KategoriLaporan">
                                        <option>Laporan Keuntungan</option>
                                        <option>Laporan Pengeluaran</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <table id="PendapatanTable" class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    {{-- <th scope="col" class="text-center">No</th> --}}
                                    <th scope="col" class="text-center">Tanggal</th>
                                    <th scope="col" class="text-center">Pendapatan</th>
                                    <th scope="col" class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Nota as $val)
                                    <tr>
                                        <td class="text-center">{{ $val->tanggalPembelian }}</td>
                                        <td class="text-center">
                                            @php
                                                $totalHarga = 0;
                                                foreach($val->Penjualan as $penjualan)
                                                {
                                                    $totalHarga += $penjualan->totalHarga;
                                                }
                                                echo $totalHarga;
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn">
                                                    <i class="fa-solid fa-circle-info text-primary" data-bs-toggle="modal" data-bs-target="#detailRiwayatModal{{$val->idNota}}" style="font-size: 24px"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="detailRiwayatModal{{$val->idNota}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Detail Transaksi idNota: {{ $val->idNota }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                    
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table id="detailRiwayatTransaksiTable" class="table table-striped table-hover" style="width: 100%;">
                                                                    <thead class="table-dark">
                                                                        <tr>
                                                                            <th scope="col" class="text-center">No</th>
                                                                            <th scope="col">Barang</th>
                                                                            <th scope="col">Jumlah</th>
                                                                            <th scope="col">Harga barang</th>
                                                                            <th scope="col">Subtotal</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php
                                                                            $nos = 1;
                                                                        @endphp
                                                                        @foreach ($val->Penjualan as $Penjualans)
                                                                        <tr>
                                                                            <th scope="row" class="text-center">{{$nos}}</th>
                                                                            <td>{{$Penjualans->Barang->namaBarang}}</td>
                                                                            <td>{{$Penjualans->jumlahBarang}}</td>
                                                                            <td>{{$Penjualans->Barang->hargaBarang}}</td>
                                                                            <td>{{$Penjualans->totalHarga}}</td>
                                                                        </tr>
                                                                        @php
                                                                            $nos++;
                                                                        @endphp
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table id="PengeluaranTable" class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    {{-- <th scope="col" class="text-center">No</th> --}}
                                    <th scope="col" class="text-center">Tanggal</th>
                                    <th scope="col" class="text-center">Pengeluaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Suplai as $val)
                                    <tr>
                                        <td class="text-center">{{ $val->tanggalMasuk }}</td>
                                        <td class="text-center">
                                            {{ $val->totalKulakan }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            @php
                                $totalPendapatan = 0;
                                foreach ($Nota as $i) {
                                    foreach ($i->Penjualan as $Penjualan) {
                                        $totalPendapatan += $Penjualan->totalHarga;
                                    }
                                }
                            @endphp
                            <span>
                                <h3 id="totalLable">Total Pendapatan {{ $totalPendapatan }}</h3>
                            </span>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>
@endsection