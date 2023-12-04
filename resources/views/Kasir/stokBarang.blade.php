@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar-kasir')
@endsection
@section('content')
<div>
    <!-- He who is contented is rich. - Laozi -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header text-center">
                    Stok Barang
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
                    <table id="barangTable" class="table table-striped table-hover" style="width: 100%;">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection