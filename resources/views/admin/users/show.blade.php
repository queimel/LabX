@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Ver usuario</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.usuarios.index')}}">Usuarios</a></li>
            <li class="breadcrumb-item active">Ver usuario</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> <img src="{{ asset('images/avatar.png') }}" class="img-circle" width="150" />
                    <h4 class="card-title m-t-10">{{$user->name}}</h4>
                    <h6 class="card-subtitle">{{$user->getRoleNames()->implode(', ')}}</h6>
                </center>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <small class="text-muted">Email address </small>
                <h6>{{$user->email}}</h6>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.usuarios.edit', $user)}}" class="button btn btn-primary btn-block">Editar</a>
            </div>
        </div>
    </div>
    <!-- Column -->

</div>
<!-- Row -->
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
@endsection
