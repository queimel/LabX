@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Modificar Encargado</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.encargados.index', $encargado)}}">Encargados</a></li>
            <li class="breadcrumb-item active">Editar encargado</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.encargados.update', $encargado)}}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edita los datos del encargado</h4>
                    <hr>
                    <div class="form-group  @error('nombre_encargado') has-danger @enderror">
                        <label>Nombres de encargado</label>
                        <input type="text" class="form-control @error('nombre_encargado') form-control-danger @enderror" id="nombre_encargado" name="nombre_encargado" value="{{ old('nombre_encargado', optional($encargado)->nombre_encargado)}}">
                        @error('nombre_encargado')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group  @error('apellidos_encargado') has-danger @enderror">
                        <label>Apellidos de encargado</label>
                        <input type="text" class="form-control @error('apellidos_encargado') form-control-danger @enderror" id="apellidos_encargado" name="apellidos_encargado" value="{{ old('apellidos_encargado', optional($encargado)->apellidos_encargado)}}">
                        @error('apellidos_encargado')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Editar encargado</button>
                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancelar</button>
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
        $("#cliente").change(function(){
            var cliente = $(this).val();
            $.get({{config('url')}}'/admin/clienteSucursalEncargado/'+cliente, function(data){
                var sucursal_select = '<option value="">Seleccione sucursal</option>'
                var small_mensaje = '<small>Debe agregar una sucursal en el modulo de clientes para continuar'
                    if(data.length == 0){
                        sucursal_select = '<option value="">No tiene sucursales cargadas</option>'
                        $("#sucursal").html(sucursal_select);
                        $("#mensaje_sucursal").html(small_mensaje).removeAttr('hidden');
                    }else{
                        for (var i=0; i<data.length;i++)
                        sucursal_select+='<option value="'+data[i].id+'">'+data[i].nombre_cliente+'</option>';
                        $("#sucursal").html(sucursal_select).removeAttr('disabled');
                    }

            });
        });

        $("#sucursal").change(function(){
            var sucursal = $(this).val();
            $.get({{config('url')}}'/admin/clienteSeccionEncargado/'+sucursal, function(data){
                var seccion_select = '<option value="">Seleccione seccion</option>'
                var small_mensaje2 = '<small>Debe agregar una sucursal en el modulo de clientes para continuar'
                    if(data.length == 0){
                        seccion_select = '<option value="">No tiene secciones cargadas</option>'
                        $("#session").html(sucursal_select);
                        $("#mensaje_seccion").html(small_mensaje2).removeAttr('hidden');
                    }else{
                        for (var i=0; i<data.length;i++)
                        seccion_select+='<option value="'+data[i].id+'">'+data[i].nombre_cliente+'</option>';
                        $("#seccion").html(seccion_select).removeAttr('disabled');
                    }
            });
        });
    });
</script>
@endpush

