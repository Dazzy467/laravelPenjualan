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