@extends('layouts.app')
@section('sidebar')
    @include('layouts.sidebar-admin')
@endsection
@section('content')
<div>
    <!-- He who is contented is rich. - Laozi -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="text-center pt-2">
                    <h3>Penjualan</h3>
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

                    <div id="chartPenjualan">
                    </div>
                    <?= $lava->render('ColumnChart', 'Penjualan', 'chartPenjualan') ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection