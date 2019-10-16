@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Crear Encargado</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.encargados.index')}}">Encargados</a></li>
            <li class="breadcrumb-item active">Crear encargado</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.encargados.store')}}">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ingresa los datos del nuevo encargado de sección</h4>
                    <hr>
                    <div class="form-group @error('is_cliente') has-danger @enderror">
                        <label for="">Clientes</label>
                        <select class="custom-select @error('is_cliente') form-control-danger @enderror" id="cliente" name="is_cliente">
                            <option selected>Seleccione cliente</option>
                                @foreach ($clientes as $cliente)
                                <option
                                    value="{{$cliente->id}}"
                                    {{ old('is_cliente') == $cliente->id ? 'selected' : '' }}
                                >
                                {{$cliente->nombre_cliente}}
                                </option>
                                @endforeach
                        </select>
                        @error('is_cliente')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                        <!-- <small>No selecccionar si el técnico que ingresará es un cliente.</small> -->
                    </div>
                    <!-- sucursales -->
                    <div class="form-group">
                        <label for="">Sucursal</label>
                        <select class="custom-select" id="sucursal" name="id_cliente_encargado" disabled required>
                        </select>
                        <small id="mensaje_sucursal" hidden></small>
                    </div>
                    <!-- end sucursales -->

                    <!-- secciones -->
                    <div class="form-group">
                        <label for="">Sección</label>
                        <select class="custom-select" id="seccion" name="id_" disabled required>
                        </select>
                        <small id="mensaje_seccion" hidden></small>
                    </div>
                    <!-- end secciones -->

                    <div class="form-group  @error('nombre_encargado') has-danger @enderror">
                        <label>Nombres del encargado</label>
                        <input type="text" class="form-control @error('nombre_encargado') form-control-danger @enderror" id="nombre_encargado" name="nombre_encargado" value="{{ old('nombre_encargado')}}">
                        @error('nombre_encargado')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group  @error('apellidos_encargado') has-danger @enderror">
                        <label>Apellidos del encargado</label>
                        <input type="text" class="form-control @error('apellidos_encargado') form-control-danger @enderror" id="apellidos_encargado" name="apellidos_encargado" value="{{ old('apellidos_encargado')}}">
                        @error('apellidos_encargado')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Crear Encargado</button>
                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Row -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso creación de encargado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>No es posible crear encargado, el cliente no tiene creada una sucursal y/o una sección</h5>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('admin.encargados.store')}}" class="d-inline" id="deleteForm">
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
