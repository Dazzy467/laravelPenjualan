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
                            <a href="{{__('admin/ManageUser')}}">
                                <div class="text-center text-white pt-2" style="font-weight: 600;">
                                    User
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <i class="fa-solid fa-user text-white" style="font-size: 32px; padding-left: 2px;"></i>
                                        <div class="text-white ps-3" style="font-weight: 600;">
                                            @php
                                                $totalUsers = count($user);
                                            @endphp
                                            {{ $totalUsers }} User
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="card rounded bg-warning col-3 overflow-hidden">
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

                        <div class="card rounded bg-success col-3 overflow-hidden">
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
        </div>
    </div>
</div>
@endsection