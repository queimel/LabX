@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Crear equipo</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.equipos.index')}}">Equipos</a></li>
            <li class="breadcrumb-item active">Crear equipo</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.equipos.store')}}">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ingresa los datos del nuevo equipo</h4>
                    <hr>
                    <div class="form-group">
                        <label for="">Modelo equipo</label>
                        <select class="custom-select" id="modelo" name="modelo_equipo">
                            <option selected>Modelo</option>
                                @foreach ($modelos as $modelo)
                                <option value="{{$modelo->id}}">{{$modelo->nombre_modelo}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nombre de Cliente</label>
                        <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" value="">
                    </div>
                    <div class="form-group  @error('rut_cliente') has-danger @enderror">
                        <label>Número de serie equipo</label>
                        <input type="text" class="form-control" id="num_serie" name="num_serie" value="">

                    </div>
                    <div class="form-group">
                        <label>Fecha fabricación</label>
                        <input type="date" class="form-control" id="fecha_fabricacion" name="fecha_fabricacion" value="2019-10-09" min="2000-01-01" max="2019-10-09">

                    </div>
                    <div class="form-group">
                        <label>Test equipo</label>
                        <input type="text" class="form-control" id="test_equipo" name="test_equipo" value="">

                    </div>
                    <div class="form-group">
                        <label>Fecha ultima mantención</label>
                        <input type="date" class="form-control" id="fecha_ultima_modificacion" name="fecha_ultima_modificacion" value="">

                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Crear equipo</button>
                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Row -->

@endsection

