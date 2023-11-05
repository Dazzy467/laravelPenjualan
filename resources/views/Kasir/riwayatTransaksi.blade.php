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
        </div>
    </div>
</div>
@endsection