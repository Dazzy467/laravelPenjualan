@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar-gudang')
@endsection
@section('content')
<div>
    <!-- He who is contented is rich. - Laozi -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="card bg-white shadow">
                <div class="text-center pt-2" style="font-weight: 600;">
                    <h3>Dashboard</h3>
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
                    <div class="d-flex justify-content-between ps-2 pe-2">
                        <div class="card rounded bg-primary col-3 overflow-hidden">
                            <a href="#">
                                <div class="text-center text-white pt-2" style="font-weight: 600;">
                                    Produk
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <i class="fa-solid fa-box text-white" style="font-size: 32px; padding-left: 2px;"></i>
                                        <div class="text-white ps-3" style="font-weight: 600;">
                                            @php
                                                $totalProduk = count($produk);
                                            @endphp
                                            {{ $totalProduk }} Produk
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="card rounded bg-primary col-3 overflow-hidden">
                            <a href="#">
                                <div class="text-center text-white pt-2" style="font-weight: 600;">
                                    Supplier
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <i class="fa-solid fa-box text-white" style="font-size: 32px; padding-left: 2px;"></i>
                                        <div class="text-white ps-3" style="font-weight: 600;">
                                            @php
                                                $totalSupplier = count($supplier);
                                            @endphp
                                            {{ $totalSupplier }} Supplier
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="card rounded bg-primary col-3 overflow-hidden">
                            <a href="#">
                                <div class="text-center text-white pt-2" style="font-weight: 600;">
                                    Produk Terjual
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <i class="fa-solid fa-boxes-packing text-white" style="font-size: 32px; padding-left: 2px;"></i>
                                        <div class="text-white ps-3" style="font-weight: 600;">
                                            @php

                                                
                                                $totalProdukTerjual = 0;

                                                foreach($penjualan as $terjual)
                                                {
                                                    $totalProdukTerjual += $terjual->jumlahBarang;
                                                }

                                                
                                            @endphp
                                            {{ $totalProdukTerjual }} Produk
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card bg-white shadow mt-2">
                <div class="text-center pt-2">
                    <h3>Catatan barang masuk</h3>
                </div>
                <div class="card-body">
                    <table id="itemSuplaiTable" class="table table-striped table-hover" style="width: 100%;">
                        <thead class="table-dark">
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Barang</th>
                            <th scope="col">Jumlah masuk</th>
                            <th scope="col">Tanggal masuk</th>
                            <th scope="col">Total Kulakan</th>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($itemSuplai as $val)
                                <tr>
                                    <td scope="row" class="text-center">{{ $no }}</td>
                                    <td>{{ $val->Supplier->nama }}</td>
                                    <td>{{ $val->Barang->namaBarang }}</td>
                                    <td>{{ $val->jumlahBarang }}</td>
                                    <td>{{ $val->tanggalMasuk }}</td>
                                    <td>{{ $val->totalKulakan }}</td>
                                </tr>
                            @php
                                $no++
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex">
                        <button class="btn btn-primary" data-bs-target="#catatSupplaiModal" data-bs-toggle="modal">Catat barang masuk</button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="catatSupplaiModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Catat Suplai</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <p>Catat barang masuk!<br>Bila terjadi salah input silahkan perbaiki di kelola barang</p>
                                    </div>
                                    <div class="row mb-3 mt-2">
                                        <label for="baranglist" class="col-md-4 col-form-label text-md-end">{{ __('Supplier') }}</label>
                                        <div class="col-md-6">
                                            <select name="idSupplier" id="idSupplier" class="form-control" required>
                                                @foreach ($supplier as $val)
                                                    <option value="{{ $val->idSupplier }}">{{ $val->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                                   
                                    <div class="row mb-3 mt-2">
                                        <label for="baranglist" class="col-md-4 col-form-label text-md-end">{{ __('Barang') }}</label>
                                        <div class="col-md-6">
                                            <select name="idBarang" id="baranglist" class="form-control @error('barang') is-invalid @enderror" required>
                                                @foreach ($produk as $val)
                                                    <option value="{{ $val->idBarang }}">{{ $val->namaBarang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3 mt-2">
                                        <label for="inputjumlahBarang" class="col-md-4 col-form-label text-md-end">{{ __('Jumlah') }}</label>
                                        <div class="col-md-6">
                                            <input id="inputjumlahBarang" type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlahBarang"  required>
                                        </div>
                                    </div>

                                    <div class="row mb-3 mt-2">
                                        <label for="inputTotalKulakan" class="col-md-4 col-form-label text-md-end">{{ __('Total kulakan') }}</label>
                                        <div class="col-md-6">
                                            <input id="inputTotalKulakan" type="number" class="form-control @error('TotalKulakan') is-invalid @enderror" name="totalKulakan"  required>
                                        </div>
                                    </div>
                               
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                    <button id="btnSubmitCatatSuplai" type="button" class="btn btn-primary">Catat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection