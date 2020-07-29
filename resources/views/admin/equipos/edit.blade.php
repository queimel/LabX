@extends('layouts.modal')
@section('title') Editar equipo @endsection
@section('content')
<form id="formEditarEquipo" method="POST" action="{{ route('admin.equipos.update', $equipo)}}" data-remote="true">
     @csrf
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

    <!-- select clientes casas matrices -->
    <div class="form-group @error('casa_matriz_equipo') has-danger @enderror">
        <label for="">Cliente</label>
 
        <select class="custom-select @error('casa_matriz_equipo') form-control-danger @enderror" id="casa_matriz_equipo" name="casa_matriz_equipo" required  @if (!$equipo->cliente->parent) @endif>
            @foreach ($casas_matrices as $casa_matriz) 
                <option
                    value="{{ $casa_matriz->id}}"
                    {{ $casa_matriz->id === $seccion->parent->parent->id ? 'selected' : ''}}
                >
                    {{$casa_matriz->nombre_cliente}}
                </option>
            @endforeach
        </option>
        </select>
        @error('casa_matriz_equipo')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>

    <!-- select clientes sucursales -->
    <div class="form-group @error('sucursal_equipo') has-danger @enderror">
        <label for="">Sucursal</label>
 
        <select class="custom-select @error('sucursal_equipo') form-control-danger @enderror" id="sucursal_equipo" name="sucursal_equipo" required>
            
        </select>
        @error('sucursal_equipo')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>

    <!--select clientes secciones sucursales -->
    <div class="form-group @error('id_cliente_equipo') has-danger @enderror">
        <label for="">Secciones</label>
 
        <select class="custom-select @error('id_cliente_equipo') form-control-danger @enderror" id="id_cliente_equipo" name="id_cliente_equipo" required>
        </select>
        @error('id_cliente_equipo')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>
</form>
@endsection
@section('footer')
    <div class="form-group d-flex justify-content-end">
        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" form="formEditarEquipo">Editar equipo</button>
        <a class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Cancelar</a>
    </div>
@endsection

@push('modal-scripts')
@javascript('casa_matriz', $seccion->parent->parent->id)
@javascript('sucursal', $seccion->parent->id)
@javascript('seccion', $seccion->id)
<script>
    $(document).ready(function(){
        getSucursales(window.casa_matriz, '#sucursal_equipo', 'sucursal');
        getSecciones(window.sucursal, '#id_cliente_equipo', 'seccion');

        $("#casa_matriz_equipo").change(function(){
            var cliente = $(this).val();
            getSucursales(cliente, '#sucursal_equipo', 'sucursal');
            $('#id_cliente_equipo').attr('disabled', 'disabled');
            $('#id_cliente_equipo').html('');
        });

        $("#sucursal_equipo").change(function(){
            var cliente = $(this).val();
            getSucursales(cliente, '#id_cliente_equipo', 'seccion');
        });
    });
    function getSucursales(cliente, dropdown, tipo){
        getClients(cliente, dropdown, tipo)
    }

    function getSecciones(cliente, dropdown, tipo){
        getClients(cliente, dropdown, tipo)
    }

    function getClients(cliente, dropdown, tipo){
        $.get({{config('url')}}'/admin/sucursales_cliente/'+cliente, function(data){
            var sucursales_select = `<option value="">Seleccione ${tipo}</option>`;
            for (var i=0; i<data.length;i++){
                if(data[i].id === window.sucursal || data[i].id === window.seccion){
                    sucursales_select+='<option value="'+data[i].id+'" selected>'+data[i].nombre_cliente+'</option>'
                }else{
                    sucursales_select+='<option value="'+data[i].id+'">'+data[i].nombre_cliente+'</option>'
                }        
            };
            $(dropdown).html(sucursales_select).removeAttr('disabled');
        });
    }

</script>
@endpush