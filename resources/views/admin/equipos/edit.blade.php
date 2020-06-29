@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Editar equipo</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.equipos.index')}}">Equipos</a></li>
            <li class="breadcrumb-item active">Editar equipo</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.equipos.update', $equipo)}}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Marca equipo</label>
                        {{ $equipo->modelo->marca->id}}
                        <select class="custom-select @error('marca_equipo') form-control-danger @enderror" id="marca" name="marca_equipo" required>
                            <option>Marca</option>
                                @foreach ($marcas as $marca)
                                <option
                                    value="{{$marca->id}}"
                                    {{ old('marca_equipo') == $marca->id ? 'selected' : '' }}
                                    {{ $marca->id === $equipo->modelo->marca->id ? 'selected' : ''}}
                                >{{$marca->nombre_marca}}</option>
                                @endforeach
                        </select>
                        @error('marca_equipo')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Modelo equipo</label>
                        <select class="custom-select @error('id_modelo_equipo') form-control-danger @enderror" id="id_modelo_equipo" name="id_modelo_equipo"  required>
                            @foreach ($modelosMarca as $modelo)
                                <option
                                    value="{{$modelo->id}}"
                                    {{ old('id_modelo_equipo') == $marca->id ? 'selected' : '' }}
                                >
                                    {{$modelo->nombre_modelo}}
                                </option>
                            @endforeach
                        </select>
                        @error('id_modelo_equipo')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>



                    <div class="form-group  @error('num_serie') has-danger @enderror">
                        <label>Número de serie equipo</label>
                        <input type="text" class="form-control @error('num_serie_equipo') form-control-danger @enderror" id="num_serie_equipo" name="num_serie_equipo" value="{{ old('num_serie_equipo', optional($equipo)->num_serie_equipo) }}">

                        @error('num_serie_equipo')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Fecha fabricación</label>
                        <input type="date" class="form-control @error('fecha_fabricacion_equipo') has-danger @enderror" id="fecha_fabricacion_equipo" name="fecha_fabricacion_equipo" value="{{ old('fecha_fabricacion_equipo', optional($equipo)->fecha_fabricacion_equipo) }}" min="2000-01-01" max="">

                        @error('fecha_fabricacion_equipo')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Asignado a</label>
                        <select class="custom-select @error('cliente_equipo_parent') form-control-danger @enderror" id="cliente_equipo_parent" name="cliente_equipo_parent"  required>
                            @foreach ($clientes as $cliente)
                                <option
                                    value="{{$cliente->id}}"
                                    {{ old('cliente_equipo_parent') == $cliente_parent->id ? 'selected' : '' }}
                                    {{ $cliente->id === $cliente_parent->id ? 'selected' : ''}}
                                >
                                    {{$cliente->nombre_cliente}}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_equipo_parent')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group @error('sucursal_equipo') has-danger @enderror">
                        <label for="">Sucursal</label>
                 
                        <select class="custom-select @error('id_cliente_equipo') form-control-danger @enderror" id="id_cliente_equipo" name="id_cliente_equipo" required>
                            @foreach ($sucursales as $sucursal)
                                <option
                                    value="{{$sucursal->id}}"
                                    {{ old('id_cliente_equipo') == $equipo->cliente->id ? 'selected' : '' }}
                                    {{ $sucursal->id === $equipo->cliente->id ? 'selected' : ''}}
                                >
                                    {{$sucursal->nombre_cliente}}
                                </option>
                            @endforeach
                        </option>
                        </select>
                        @error('id_cliente_equipo')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="hidden" name="test_equipo" value="{{ old('test_equipo', optional($equipo)->test_equipo) }}">
                    <input type="hidden" name="fecha_ultima_mantencion_equipo" value="{{ old('test_equipo', optional($equipo)->fecha_ultima_mantencion_equipo) }}">
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Editar equipo</button>
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
        $("#id_cliente_equipo").change(function(){
            var cliente = $(this).val();
            $.get({{config('url')}}'/admin/sucursales_cliente/'+cliente, function(data){
                var sucursales_select = '<option value="">Seleccione Sucursal</option>'
                    for (var i=0; i<data.length;i++)
                    sucursales_select+='<option value="'+data[i].id+'">'+data[i].nombre_cliente+'</option>';
                    $("#sucursal_equipo").html(sucursales_select).removeAttr('disabled');
            });
        });
    });
</script>
@endpush
