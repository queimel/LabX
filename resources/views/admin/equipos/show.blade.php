@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Ver equipo</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.equipos.index')}}">Equipos</a></li>
            <li class="breadcrumb-item active"> Ver equipo</li>
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
                <h3>{{ $equipo->modelo->marca->nombre_marca}}</h3>
                <h4 class="card-title m-t-10">{{$equipo->modelo->nombre_modelo}}</h4>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <small class="text-muted">Asignado a: </small>
                <h6>{{$equipo->cliente->nombre_cliente}}</h6>
            </div>
            <div class="card-body">
                <small class="text-muted">Número de serie </small>
                <h6>
                    {{$equipo->num_serie_equipo}}
                </h6>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.equipos.edit', $equipo)}}" class="button btn btn-primary btn-block">Editar</a>
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

