@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Crear Mantenimiento</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.clientes.index')}}">Mantenimientos</a></li>
            <li class="breadcrumb-item active">Crear mantenimiento</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.mantenimientos.store')}}">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    <!-- select clientes casas matrices -->
                    <div class="form-group @error('casa_matriz') has-danger @enderror">
                        <label for="">Cliente</label>
                 
                        <select class="custom-select @error('casa_matriz') form-control-danger @enderror" id="casa_matriz" name="casa_matriz" required>
                            <option value="">Seleccionar</option>
                            @foreach ($secciones as $seccion) 
                                <option
                                    value="{{ $seccion->parent->parent->id}}"
                                >
                                    {{$seccion->parent->parent->nombre_cliente}}
                                </option>
                            @endforeach
                        </option>
                        </select>
                        @error('casa_matriz')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- select clientes sucursales -->
                    <div class="form-group @error('sucursal_equipo') has-danger @enderror">
                        <label for="">Sucursal</label>
                 
                        <select class="custom-select @error('sucursal_equipo') form-control-danger @enderror" id="sucursal_equipo" name="sucursal_equipo" required disabled>
                            
                        </select>
                        @error('sucursal_equipo')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <!--select clientes secciones sucursales -->
                    <div class="form-group @error('id_cliente_equipo') has-danger @enderror">
                        <label for="">Secciones</label>
                 
                        <select class="custom-select @error('id_cliente_equipo') form-control-danger @enderror" id="id_cliente_equipo" name="id_cliente_equipo" required disabled>
                        </select>
                        @error('id_cliente_equipo')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- equipo de cliente -->
                    <div class="form-group @error('id_equipo_mantenimiento') has-danger @enderror">
                        <label for="">Equipo</label>
                        <select class="custom-select @error('id_equipo_mantenimiento') form-control-danger @enderror" id="id_equipo_mantenimiento" name="id_equipo_mantenimiento"  disabled required>

                        </select>
                        @error('id_equipo_mantenimiento')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Fecha mantenimiento</label>
                        <input type="date" class="form-control @error('fecha_mantenimiento') has-danger @enderror" id="fecha_mantenimiento" name="fecha_mantenimiento" value="" min="2000-01-01" max="">

                        @error('fecha_mantenimiento')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- tecnicos -->
                    <div class="form-group @error('id_tecnico_mantenimiento') has-danger @enderror">
                        <label for="">Tecnico asignado</label>
                 
                        <select class="custom-select @error('id_tecnico_mantenimiento') form-control-danger @enderror" id="id_tecnico_mantenimiento" name="id_tecnico_mantenimiento" required >
                            @foreach ($tecnicos as $tecnico) 
                                <option value = {{ $tecnico->id}}>
                                    {{$tecnico->user->name}}
                                </option>
                            @endforeach
                        </option>
                        </select>
                        @error('id_tecnico_mantenimiento')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Crear Mantenimiento</button>
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
            $.get({{config('url')}}'/admin/equipos_cliente/'+cliente, function(data){
                var equipos_select = '<option value="">Seleccione Equipo</option>'
                    for (var i=0; i<data.length;i++)
                    equipos_select+=`<option value="${data[i].id}">${data[i].modelo.marca.nombre_marca} - ${data[i].modelo.nombre_modelo}</option>`;
                    $("#id_equipo_mantenimiento").html(equipos_select).removeAttr('disabled');
            });
        });

        $("#casa_matriz").change(function(){
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
                sucursales_select+='<option value="'+data[i].id+'">'+data[i].nombre_cliente+'</option>'       
            };
            $(dropdown).html(sucursales_select).removeAttr('disabled');
        });
    }

</script>
@endpush
