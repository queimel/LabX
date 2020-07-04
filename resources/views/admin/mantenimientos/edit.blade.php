@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Editar mantenimiento</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.equipos.index')}}">mantenimientos</a></li>
            <li class="breadcrumb-item active">Editar mantenimiento</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.mantenimientos.update', $mantenimiento)}}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    <!-- input equipo disabled -->
                   <div class="form-group">
                        <label>Equipo</label>
                        <input type="text" class="form-control @error('id_equipo_mantenimiento') has-danger @enderror" id="id_equipo_mantenimiento" name="id_equipo_mantenimiento" value="{{ old('id_equipo_mantenimiento', optional($mantenimiento)->equipo->modelo->nombre_modelo) }}" disabled>
                        @error('id_equipo_mantenimiento')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>                   

                    <!-- input marca equipo disabled -->
                   <div class="form-group">
                        <label>Marca equipo</label>
                        <input type="text" class="form-control @error('mantenimiento_equipo_marca') has-danger @enderror" id="mantenimiento_equipo_marca" name="mantenimiento_equipo_marca" value="{{ old('mantenimiento_equipo_marca', optional($mantenimiento)->equipo->modelo->marca->nombre_marca) }}" disabled>
                        @error('mantenimiento_equipo_marca')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div> 
                    <div class="form-group  @error('mantenimiento_equipo_num_serie') has-danger @enderror">
                        <label>Número de serie equipo</label>
                        <input type="text" class="form-control @error('mantenimiento_equipo_num_serie') form-control-danger @enderror" id="mantenimiento_equipo_num_serie" name="mantenimiento_equipo_num_serie" value="{{ old('mantenimiento_equipo_num_serie', optional($mantenimiento)->equipo->num_serie_equipo) }}" disabled>

                        @error('mantenimiento_equipo_num_serie')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- input cliente equipo disabled -->
                    @if ($mantenimiento->equipo->cliente->parent)
                        <div class="form-group">
                            <label>Cliente</label>
                            <input type="text" class="form-control @error('mantenimiento_equipo') has-danger @enderror" id="mantenimiento_equipo" name="mantenimiento_equipo" value="{{ old('mantenimiento_equipo', optional($mantenimiento)->equipo->cliente->parent->nombre_cliente) }}" disabled>
                            @error('mantenimiento_equipo')
                            <small class="form-control-feedback">{{ $message }}</small>
                            @enderror
                        </div> 
                        <div class="form-group">
                            <label>Sucursal cliente</label>
                            <input type="text" class="form-control @error('mantenimiento_equipo') has-danger @enderror" id="mantenimiento_equipo" name="mantenimiento_equipo" value="{{ old('mantenimiento_equipo', optional($mantenimiento)->equipo->cliente->nombre_cliente) }}" disabled>
                            @error('mantenimiento_equipo')
                            <small class="form-control-feedback">{{ $message }}</small>
                            @enderror
                        </div> 
                    @else
                    <div class="form-group">
                        <label>Cliente</label>
                        <input type="text" class="form-control @error('mantenimiento_equipo') has-danger @enderror" id="mantenimiento_equipo" name="mantenimiento_equipo" value="{{ old('mantenimiento_equipo', optional($mantenimiento)->equipo->cliente->nombre_cliente) }}" disabled>
                        @error('mantenimiento_equipo')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>                         
                    @endif

                    <div class="form-group">
                        <label>Fecha mantenimiento</label>
                        <input type="date" class="form-control @error('fecha_mantenimiento') has-danger @enderror" id="fecha_mantenimiento" name="fecha_mantenimiento" value="{{ old('fecha_mantenimiento', $fecha_mantenimiento) }}" min="2000-01-01" max="">

                        @error('fecha_mantenimiento')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- tecnicos -->
                    <div class="form-group @error('id_tecnico_mantenimiento') has-danger @enderror">
                        <label for="">Tecnico asignado</label>
                 
                        <select class="custom-select @error('id_tecnico_mantenimiento') form-control-danger @enderror" id="id_tecnico_mantenimiento" name="id_tecnico_mantenimiento" required >
                            @foreach ($tecnicos as $tecnico) 
                                <option
                                    value="{{$tecnico->id}}"
                                    {{ old('id_tecnico_mantenimiento') == $mantenimiento->tecnico->id ? 'selected' : '' }}
                                    {{ $tecnico->id === $mantenimiento->tecnico->id ? 'selected' : ''}}
                                >
                                    {{$tecnico->nombre_tecnico}} {{$tecnico->apellido_tecnico}}
                                </option>
                            @endforeach
                        </option>
                        </select>
                        @error('id_tecnico_mantenimiento')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

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
{{-- @javascript('hasParent', $equipo->cliente->parent)
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
</script> --}}

@endpush
