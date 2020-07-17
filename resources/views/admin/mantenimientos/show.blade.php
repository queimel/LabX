@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Ver mantenimiento</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.mantenimientos.index')}}">Mantenimientos</a></li>
            <li class="breadcrumb-item active"> Ver mantenimiento</li>
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
                <h4 class="card-title m-t-10">Mantenimiento {{$mantenimiento->equipo->modelo->marca->nombre_marca}} - {{$mantenimiento->equipo->modelo->nombre_modelo}}</h4>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <small class="text-muted">Fecha de mantenimiento</small>
                <h6>
                    {{date('d-m-Y', strtotime($mantenimiento->fecha_mantenimiento))}}
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">Cliente</small>
                <h6>
                    {{$mantenimiento->equipo->cliente->parent->parent->nombre_cliente}}
                </h6>
                <h6>
                    Sucursal: {{$mantenimiento->equipo->cliente->parent->nombre_cliente}}
                </h6>
                <h6>
                    Seccion: {{$mantenimiento->equipo->cliente->nombre_cliente}}
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">Dirección </small>
                <h6>
                    {{$mantenimiento->equipo->cliente->direccion_cliente}}, {{$mantenimiento->equipo->cliente->comuna->nombre_comuna}}
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">Tecnico a cargo </small>
                <h6>
                    {{$mantenimiento->tecnico->user->name}}
                </h6>
                <small class="text-muted">Telefono(s) </small>

                @foreach ($mantenimiento->tecnico->telefonos as $telefono)
                <h6>
                    {{$telefono->numero_telefono}}
                </h6>
                @endforeach

            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.mantenimientos.edit', $mantenimiento)}}" class="button btn btn-primary btn-block">Editar</a>
            </div>
        </div>
    </div>
    <!-- Column -->

<!-- Row -->
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->



@endsection

