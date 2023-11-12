@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar-gudang')
@endsection
@section('content')
<div>
    @if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
    <table id="barangTable" class="table table-striped table-hover" style="width: 100%;">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col">Barang</th>
                <th scope="col">Stok</th>
                <th scope="col">Harga</th>
                <th scope="col" class="text-center">Aksi</th>
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

                <td>
                    <div class="d-flex justify-content-center">
                        <div>
                            <a href="{{__('EditBarang/'.$val->idBarang)}}" class="fa-solid fa-pen-to-square pe-2 text-primary" style="font-size: 24px;"></a>
                            <a href="{{__('DeleteBarang/'.$val->idBarang)}}" class="fa-solid fa-trash-can text-danger" style="font-size: 24px;"></a>
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
    <div class="d-flex">
        <a href="TambahBarangForm" class="btn btn-primary">
            <span>Tambah Barang</span>
        </a>
    </div>
</div>
@endsection