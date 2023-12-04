@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar-gudang')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Barang') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('gudang.editbarang') }}">
                        @csrf
                        <input type="hidden" id="id" name="idBarang" value="{{$Barang->idBarang}}">

                        <div class="row mb-3">
                            <label for="namaBarang" class="col-md-4 col-form-label text-md-end">{{ __('Nama barang') }}</label>

                            <div class="col-md-6">
                                <input id="namaBarang" type="text" class="form-control @error('namaBarang') is-invalid @enderror" name="namaBarang" value="{{ $Barang->namaBarang }}" required autofocus>

                                @error('namaBarang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="stokBarang" class="col-md-4 col-form-label text-md-end">{{ __('Stok barang') }}</label>

                            <div class="col-md-6">
                                <input id="stokBarang" type="number" class="form-control @error('stokBarang') is-invalid @enderror" name="stokBarang" value="{{ $Barang->stokBarang }}" required>

                                @error('stokBarang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="hargaBarang" class="col-md-4 col-form-label text-md-end">{{ __('Harga barang') }}</label>

                            <div class="col-md-6">
                                <input id="hargaBarang" type="number" class="form-control @error('hargaBarang') is-invalid @enderror" name="hargaBarang" value="{{ $Barang->hargaBarang }}" required>

                                @error('hargaBarang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                                <a href="/gudang/KelolaBarang" class="btn btn-primary">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
