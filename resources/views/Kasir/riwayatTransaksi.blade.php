@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar-kasir')
@endsection
@section('content')
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card bg-white shadow">
                <div class="text-center pt-2" style="font-weight: 600; font-size: 24px;">
                    Riwayat Transaksi
                </div>
                <div class="text-center pt-2" style="font-size: medium;">
                    <p>
                        Selamat datang! <br>

                        {{ Auth::user()->name}}
                    </p>
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
                    

                    <table id="riwayatTransaksiTable" class="table table-striped table-hover" style="width: 100%;">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col">ID Nota</th>
                                <th scope="col">Nama Kasir</th>
                                <th scope="col">Tanggal Pembelian</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col" class="text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;

                            @endphp
                            @foreach ($Nota as $val)
                            <tr>
                                <th scope="row" class="text-center">{{$no}}</th>
                                <td>{{$val->idNota}}</td>
                                <td>{{$val->User->name}}</td>
                                <td>{{$val->tanggalPembelian}}</td>
                                <td>
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
                            @php
                                $no++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>
    </div>
</div>
@endsection