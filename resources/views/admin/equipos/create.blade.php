{{-- @extends('layouts.app')
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
                    <div class="form-group @error('marca_equipo') has-danger @enderror">
                        <label for="">Marca equipo</label>
                        <select class="custom-select @error('marca_equipo') form-control-danger @enderror" id="marca" name="marca_equipo" required>
                            <option selected>Marca</option>
                                @foreach ($marcas as $marca)
                                <option
                                    value="{{$marca->id}}"
                                    {{ old('marca_equipo') == $marca->id ? 'selected' : '' }}
                                >
                                {{$marca->nombre_marca}}
                                </option>
                                @endforeach
                        </select>
                        @error('marca_equipo')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group @error('id_modelo_equipo') has-danger @enderror">
                        <label for="">Modelo equipo</label>
                        <select class="custom-select @error('id_modelo_equipo') form-control-danger @enderror" id="id_modelo_equipo" name="id_modelo_equipo"  disabled required>

                        </select>
                        @error('id_modelo_equipo')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group  @error('num_serie_equipo') has-danger @enderror">
                        <label>Número de serie equipo</label>
                        <input type="text" class="form-control @error('num_serie_equipo') form-control-danger @enderror" id="num_serie_equipo" name="num_serie_equipo" value="{{ old('num_serie_equipo')}}">
                        @error('num_serie_equipo')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group @error('fecha_fabricacion_equipo') has-danger @enderror">
                        <label>Fecha fabricación</label>
                        <input type="date" class="form-control" id="fecha_fabricacion_equipo" name="fecha_fabricacion_equipo" value="{{ old('fecha_fabricacion_equipo')}}" min="2000-01-01" max="{{ Carbon\Carbon::now()}}">
                        @error('fecha_fabricacion_equipo')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Crear equipo</button>
                        <a class="btn btn-inverse waves-effect waves-light" href="{{ URL::previous() }}">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Row -->

@endsection

@push('scripts')
<script src="{{ asset('js/plugins/jquery/jquery.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#marca").change(function(){
            var marca = $(this).val();
            $.get({{config('url')}}'/admin/modeloPorMarca/'+marca, function(data){
                var modelos_select = '<option value="">Seleccione Modelo</option>'
                    for (var i=0; i<data.length;i++)
                    modelos_select+='<option value="'+data[i].id+'">'+data[i].nombre_modelo+'</option>';
                    $("#id_modelo_equipo").html(modelos_select).removeAttr('disabled');
            });
        });
    });
</script>
@endpush --}}


@extends('layouts.modal')
@section('title') Crear Equipo @endsection
@section('content')
<form id="formCrearEquipo" action="{{ route('admin.equipos.store')}}" method="POST" data-remote="true">
     @csrf
     <div class="form-group @error('marca_equipo') has-danger @enderror">
        <label for="">Marca equipo</label>
        <select class="custom-select @error('marca_equipo') form-control-danger @enderror" id="marca" name="marca_equipo" required>
            <option selected>Marca</option>
                @foreach ($marcas as $marca)
                <option
                    value="{{$marca->id}}"
                    {{ old('marca_equipo') == $marca->id ? 'selected' : '' }}
                >
                {{$marca->nombre_marca}}
                </option>
                @endforeach
        </select>
        @error('marca_equipo')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group @error('id_modelo_equipo') has-danger @enderror">
        <label for="">Modelo equipo</label>
        <select class="custom-select @error('id_modelo_equipo') form-control-danger @enderror" id="id_modelo_equipo" name="id_modelo_equipo"  disabled required>

        </select>
        @error('id_modelo_equipo')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group  @error('num_serie_equipo') has-danger @enderror">
        <label>Número de serie equipo</label>
        <input type="text" class="form-control @error('num_serie_equipo') form-control-danger @enderror" id="num_serie_equipo" name="num_serie_equipo" value="{{ old('num_serie_equipo')}}">
        @error('num_serie_equipo')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group @error('fecha_fabricacion_equipo') has-danger @enderror">
        <label>Fecha fabricación</label>
        <input type="date" class="form-control" id="fecha_fabricacion_equipo" name="fecha_fabricacion_equipo" value="{{ old('fecha_fabricacion_equipo')}}" min="2000-01-01" max="{{ Carbon\Carbon::now()}}">
        @error('fecha_fabricacion_equipo')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>
</form>
@endsection
@section('footer')
    <div class="form-group d-flex justify-content-end">
        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" form="formCrearEquipo">Crear equipo</button>
        <a class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Cancelar</a>
    </div>
@endsection

@push('modal-scripts')
    <script>
        $(document).ready(function(){
            $("#marca").change(function(){
                var marca = $(this).val();
                $.get({{config('url')}}'/admin/modeloPorMarca/'+marca, function(data){
                    var modelos_select = '<option value="">Seleccione Modelo</option>'
                        for (var i=0; i<data.length;i++)
                        modelos_select+='<option value="'+data[i].id+'">'+data[i].nombre_modelo+'</option>';
                        $("#id_modelo_equipo").html(modelos_select).removeAttr('disabled');
                });
            });
        });
    </script> 
@endpush