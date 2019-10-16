@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Ver Técnico</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.equipos.index')}}">Técnicos</a></li>
            <li class="breadcrumb-item active"> Ver técnico</li>
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
                <h4 class="card-title m-t-10">{{$tecnico->nombre_tecnico}} {{$tecnico->apellido_tecnico}}</h4>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <small class="text-muted">RUN</small>
                <h6>{{$tecnico->run_tecnico}}</h6>
            </div>
            @if ($tecnico->supervisor)
            <div>
                <hr>
            </div>
            <div class="card-body">
                <small class="text-muted">Supervisor </small>
                <h6>
                    {{$tecnico->supervisor->nombre_tecnico}} {{$tecnico->supervisor->apellido_tecnico}}
                </h6>
            </div>

            @endif
            @if ($tecnico->tecnicos)
            <div>
                <hr>
            </div>
            <div class="card-body">
                <small class="text-muted">Técnicos subalternos </small>
                @foreach ($tecnico->tecnicos as $tecnico)
                    <h6>{{$tecnico->nombre_tecnico}} {{$tecnico->apellido_tecnico}}</h6>
                @endforeach

            </div>
            @endif
            <div>
                <hr>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.tecnicos.edit', $tecnico)}}" class="button btn btn-primary btn-block">Editar</a>
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

