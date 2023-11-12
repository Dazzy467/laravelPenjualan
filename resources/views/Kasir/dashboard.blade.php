@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar-kasir')
@endsection
@section('content')

<div>
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
                        <div class="card rounded bg-danger col-3 overflow-hidden">
                            <a href="{{__('admin/Dummy')}}">
                                <div class="text-center text-white pt-2" style="font-weight: 600;">
                                    Dummy
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <i class="fa-solid fa-user text-white" style="font-size: 32px; padding-left: 2px;"></i>
                                        <div class="text-white ps-3" style="font-weight: 600;">
                                            0 Dummy
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
                    <h3>Transaksi</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end">                            
                        <button id="btnBuatTransaksi" class="btn btn-primary align-content-center">
                                Buat Transaksi
                        </button>
                        <form id="formBuatTransaksi">
                            @csrf
                        </form>                    

                    </div>
                    <div class="mt-3">
                        <div class="d-flex">
                            <h3 id="notaID"></h3>
                        </div>
                        <table id="transactionTable" class="table table-striped table-hover" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga Satuan</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                                    $penjualanInstance = [];
                                    if(session()->has('penjualanInstance'))
                                    {
                                        $penjualanInstance = session()->get('penjualanInstance');
                                    }
                                    
                                @endphp
                                @foreach ($penjualanInstance as $penjualan)
                                    <td>{{ $penjualan->Barang->namaBarang}}</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span>{{$penjualan->jumlahBarang}}</span>                 
                                            <div class="d-flex">
                                                <a href="#" class="fa-solid fa-plus text-primary pe-2" style="font-size: 24px;"></a>
                                                <a href="#" class="fa-solid fa-minus text-danger" style="font-size: 24px;"></a>
                                            </div>
                                        </div>


                                    </td>
                                    <td>{{$penjualan->Barang->hargaBarang}}</td>
                                    <td>{{$penjualan->Barang->hargaBarang * $penjualan->jumlahBarang}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <a href="#" class="fa-solid fa-trash-can text-danger" style="font-size: 24px;"></a>
                                            </div>
                                            
                                        </div>
                                    </td>
                                </tr>
                                @endforeach --}}
                                {{-- <tr>
                                    <td>PVC</td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <span>5</span>                 
                                            <div class="d-flex">
                                                <a href="#" class="fa-solid fa-plus text-primary pe-2" style="font-size: 24px;"></a>
                                                <a href="#" class="fa-solid fa-minus text-danger" style="font-size: 24px;"></a>
                                            </div>
                                        </div>


                                    </td>
                                    <td>15000</td>
                                    <td>75000</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <a href="#" class="fa-solid fa-trash-can text-danger" style="font-size: 24px;"></a>
                                            </div>
                                            
                                        </div>
                                    </td>
                                </tr> --}}

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <h3 id="labelTotalHarga" class="pt-2 pb-2"></h3>
                        </div>
                        <div class="d-flex">
                            <div>
                                <button type="button" id="btnTambahBarangTransaksi" class="btn btn-primary disabled" data-bs-toggle="modal" data-bs-target="#tambahBarangModal" style="color: white; font-weight: bold;">Tambah barang</button>
                            </div>
                            <div class="ps-2">
                                <a href="/kasir/simpanTransaksi" id="btnKonfirmasiTransaksi" class="btn btn-primary disabled" style="color: white; font-weight: bold;">Konfirmasi Transaksi</a>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="tambahBarangModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table id="tambahBarangTable" class="table table-striped table-hover" style="width: 100%;">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col" class="text-center">No</th>
                                                    <th scope="col">Barang</th>
                                                    <th scope="col">Stok</th>
                                                    <th scope="col">Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($Barang as $val)
                                                <tr>
                                                    <th scope="row" class="text-center">{{$no}}</th>
                                                    <td>{{$val->namaBarang}}</td>
                                                    <td>{{$val->stokBarang}}</td>
                                                    <td>{{$val->hargaBarang}}</td>
                                                </tr>
                                                @php
                                                    $no++;
                                                @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                          
                                        <div class="row mb-3 mt-2">
                                            <label for="baranglist" class="col-md-4 col-form-label text-md-end">{{ __('Barang') }}</label>
                                            <div class="col-md-6">
                                                <select name="idBarang" id="baranglist" class="form-control @error('barang') is-invalid @enderror" required>
                                                    @foreach ($Barang as $val)
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
                                   
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                        <button id="btnSubmitTambahBarangTransaksiKasir" type="button" class="btn btn-primary">Tambahkan</button>
                                    </div>
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