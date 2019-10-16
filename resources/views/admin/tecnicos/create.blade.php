@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Crear Técnico</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.tecnicos.index')}}">Técnicos</a></li>
            <li class="breadcrumb-item active">Crear técnico</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.tecnicos.store')}}">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ingresa los datos del nuevo tecnico</h4>
                    <hr>
                    <div class="form-group  @error('nombre_tecnico') has-danger @enderror">
                        <label>Nombres de técnico</label>
                        <input type="text" class="form-control @error('nombre_tecnico') form-control-danger @enderror" id="nombre_tecnico" name="nombre_tecnico" value="{{ old('nombre_tecnico')}}">
                        @error('nombre_tecnico')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group  @error('apellido_tecnico') has-danger @enderror">
                        <label>Apellidos de técnico</label>
                        <input type="text" class="form-control @error('apellido_tecnico') form-control-danger @enderror" id="apellido_tecnico" name="apellido_tecnico" value="{{ old('apellido_tecnico')}}">
                        @error('apellido_tecnico')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group  @error('run_tecnico') has-danger @enderror">
                        <label>RUN de técnico</label>
                        <input type="text" class="form-control @error('run_tecnico') form-control-danger @enderror" id="run_tecnico" name="run_tecnico" value="{{ old('run_tecnico')}}">
                        @error('run_tecnico')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group @error('supervisor_id') has-danger @enderror">
                        <label for="">Supervisor</label>
                        <select class="custom-select @error('supervisor_id') form-control-danger @enderror" id="marca" name="supervisor_id">
                            <option selected>Supervisor</option>
                                @foreach ($supervisores as $supervisor)
                                <option
                                    value="{{$supervisor->id}}"
                                    {{ old('supervisor_id') == $supervisor->id ? 'selected' : '' }}
                                >
                                {{$supervisor->nombre_tecnico}} {{$supervisor->apellido_tecnico}}
                                </option>
                                @endforeach
                        </select>
                        @error('supervisor_id')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                        <small>No selecccionar si el técnico que ingresará es un supervisor.</small>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Crear Técnico</button>
                        <a class="btn btn-inverse waves-effect waves-light" href="{{ URL::previous() }}">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Row -->

@endsection

