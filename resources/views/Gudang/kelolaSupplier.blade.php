@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar-gudang')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card bg-white shadow">
            <div class="text-center pt-2" style="font-weight: 600;">
                <h3>Manajemen Supplier</h3>
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
                <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
                <table id="supplierTable" class="table table-striped table-hover" style="width: 100%;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Nama supplier</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No telpon</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($Supplier as $val)
                        <tr>
                            <th scope="row" class="text-center">{{$no}}</th>
                            <td>{{$val->nama}}</td>
                            <td>{{$val->alamat}}</td>
                            <td>{{$val->noTelp}}</td>

                            <td>
                                <div class="d-flex justify-content-center">
                                    <div>
                                        <a href="{{__('EditSupplier/'.$val->idSupplier)}}" class="fa-solid fa-pen-to-square pe-2 text-primary" style="font-size: 24px;"></a>
                                        <a href="{{__('DeleteSupplier/'.$val->idSupplier)}}" class="fa-solid fa-trash-can text-danger" style="font-size: 24px;"></a>
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
                    <a href="TambahSupplierForm" class="btn btn-primary">
                        <span>Tambah Supplier</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection