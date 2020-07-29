@extends('layouts.app')


@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Editar Marca</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.marcas.index')}}">Marcas</a></li>
            <li class="breadcrumb-item active">Editar {{$marca->nombre_marca}}</li>
        </ol>
    </div>
</div>
@endpush

@section('content')
<!-- Row -->

    <div class="row">
        <div class="col-md-5 col-xs-12">
            <form class="form" method="POST" action="{{ route('admin.marcas.update', $marca)}}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group  @error('nombre_marca') has-danger @enderror">
                            <label for="exampleInputunombre_marca">Nombre de marca</label>
                            <input type="text" class="form-control  @error('nombre_marca') form-control-danger @enderror" id="nombre_marca" name="nombre_marca" value="{{ old('nombre_marca', optional($marca)->nombre_marca) }}">
                            @error('nombre_marca')
                            <small class="form-control-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group @error('origen_marca') has-danger @enderror">
                            <label class="control-label">Origen</label>
                            <select class="custom-select" name="origen_marca">
                                @foreach ($paises as $pais)
                                    <option
                                    value="{{$pais->id}}"
                                    {{ $pais->id == $marca->pais->id ? 'selected' : ''}}
                                    >{{$pais->name}}
                                </option>
                                @endforeach
                            </select>
                            @error('origen_marca')
                            <small class="form-control-feedback d-block">{{ $message }}</small>
                            @enderror
                        </div>
                        <hr>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Editar Marca</button>
                            <a class="btn btn-inverse waves-effect waves-light" href="{{ URL::previous() }}">Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Modelos {{$marca->nombre_marca}}</h4>
                        <div>
                            <a href="{{ route('admin.modelos.create', $marca)}}" class="btn btn-primary btn-sm" data-remote="true">
                                <i class="fa fa-plus"></i> Nuevo Modelo
                            </a>
                        </div>
                    </div>
                    <hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Frecuencia Mantención</th>
                                <th class="text-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marca->modelos as $modelo)
                                <tr>
                                    <td>
                                    </td>
                                    <td>{{$modelo->nombre_modelo}}</td>
                                    <td >
                                        {{$modelo->frecuencia_modelo}}
                                    </td>
                                    <td class="text-nowrap">
                                        <a  href="{{ route('admin.modelos.edit', $modelo)}}" data-remote="true"> 
                                            <i class="fa fa-pencil text-inverse m-r-10"></i>
                                        </a>
                                        <a href="{{ route('admin.modelos.show', $modelo) }}" data-remote="true" 
                                        data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                                    </td>
                                </tr>                               
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

<!-- Row -->

@endsection

@push('styles')

@endpush

@push('scripts')


@endpush
