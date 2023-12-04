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
                <div class="card-header text-center">
                    Users
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
                    <table id="userTable" class="table table-striped table-hover" style="width: 100%;">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($user as $val)
                            <tr>
                                <th scope="row" class="text-center">{{$no}}</th>
                                <td>{{$val->name}}</td>
                                <td>{{$val->email}}</td>
                                @if ($val->role == 0)
                                    <td>Admin</td>
                                @elseif ($val->role == 1)
                                    <td>Kasir</td>
                                @endif
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div>
                                            <a href="{{__('/EditUser/'.$val->idUser)}}" class="fa-solid fa-pen-to-square pe-2 text-primary" style="font-size: 24px;"></a>
                                            <a href="{{__('/DeleteUser/'.$val->idUser)}}" class="fa-solid fa-trash-can text-danger" style="font-size: 24px;"></a>
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
                        <div>
                            <a href="{{ route('admin.adduser_form') }}" class="btn btn-warning" style="color: white; font-weight: bold;">Tambah user</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection