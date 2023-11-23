@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar-admin')
@endsection
@section('content')
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
                                <div class="col-md-3">
                                    <label class="row">Mulai tanggal</label>
                                    <input class="row" type="date" placeholder="Tanggal">
                                </div>
                                <div class="col-md-3">
                                    <label class="row">Sampai tanggal</label>
                                    <input class="row" type="date" placeholder="Tanggal">
                                </div>
                                <div class="col-md-3">
                                    <label class="row">Kategori</label>
                                    <select class="row">
                                        <option>Laporan laba</option>
                                        <option>Laporan Keuntungan</option>
                                        <option>Laporan Pengeluaran</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <button class="row mt-3 btn btn-primary">Tampilkan</button>
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