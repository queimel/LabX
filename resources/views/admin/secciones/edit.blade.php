{{-- @extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Editar Seccion Sucursal</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.clientes.index')}}">Clientes</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.clientes.index')}}">Sucursales</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.clientes.show', $seccion)}}">{{$seccion->nombre_cliente}}</a></li>
            <li class="breadcrumb-item active">Editar seccion</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.secciones.update', $seccion)}}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Editar {{ $seccion->nombre_cliente}}</h4>
                    <hr>
                    <input type="hidden" id="id" name="id" value="{{$seccion->id}}">
                    <div class="form-group  @error('nombre_cliente') has-danger @enderror">
                        <label>Nombre de Sucursal</label>
                        <input type="text" class="form-control  @error('nombre_cliente') form-control-danger @enderror"
                            id="nombre_cliente" name="nombre_cliente"
                            value="{{ old('nombre_cliente', optional($seccion)->nombre_cliente) }}">
                        @error('nombre_cliente')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <input type="hidden" id="rut_cliente" name="rut_cliente"
                        value="{{ old('rut_cliente', optional($seccion)->rut_cliente)}}">

                    <div class="form-group  @error('descripcion_cliente') has-danger @enderror">
                        <label>Descripcion</label>
                        <textarea class="form-control  @error('descripcion_cliente') form-control-danger @enderror"
                            id="descripcion_cliente" name="descripcion_cliente">
                                {{ old('descripcion_cliente', optional($seccion)->descripcion_cliente)}}
                            </textarea>
                        @error('descripcion')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group  @error('direccion_cliente') has-danger @enderror">
                        <label>Dirección</label>
                        <input type="text"
                            class="form-control  @error('direccion_cliente') form-control-danger @enderror"
                            id="direccion_cliente" name="direccion_cliente"
                            value="{{ old('direccion_cliente',  optional($seccion)->direccion_cliente)}}">
                        @error('direccion_cliente')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Region</label>
                        <select class="custom-select" id="region" name="region_cliente" required>
                            <option selected>Region</option>
                            @foreach ($regiones as $regionsel)
                            <option value="{{$regionsel->id}}"
                                {{ $provincia->region->id == $regionsel->id ? 'selected' : ''}}>
                                {{$regionsel->nombre_region}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Provincia</label>
                        <select class="custom-select" id="provincia" name="provincia_cliente" required>
                            @foreach ($provinciasdeRegion as $provinciaRegion)
                            <option value="{{$provinciaRegion->id}}"
                                {{ $provincia->id == $provinciaRegion->id ? 'selected' : ''}}>
                                {{$provinciaRegion->nombre_provincia}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Comuna</label>
                        <select class="custom-select" id="comuna" name="id_comuna" required>
                            @foreach ($comunasdeProvincia as $comunaProvincia)
                            <option value="{{$comunaProvincia->id}}"
                                {{ $seccion->comuna->id == $comunaProvincia->id ? 'selected' : ''}}>
                                {{$comunaProvincia->nombre_comuna}}
                            </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Editar
                            Sucursal</button>
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
        $("#region").change(function(){
            var region = $(this).val();
            $.get({{config('url')}}'/admin/provinciasPorRegion/'+region, function(data){
                var provincias_select = '<option value="">Seleccione Provincia</option>'
                    for (var i=0; i<data.length;i++)
                    provincias_select+='<option value="'+data[i].id+'">'+data[i].nombre_provincia+'</option>';

                    $("#provincia").html(provincias_select).removeAttr('disabled');
            });
        });

        $("#provincia").change(function(){
            var provincia = $(this).val();
            $.get({{config('url')}}'/admin/comunasPorProvincia/'+provincia, function(data){
                var comunas_select = '<option value="">Seleccione Comuna</option>'
                    for (var i=0; i<data.length;i++)
                    comunas_select+='<option value="'+data[i].id+'">'+data[i].nombre_comuna+'</option>';

                    $("#comuna").html(comunas_select).removeAttr('disabled');
            });
        });
    });
</script>
@endpush --}}


@extends('layouts.modal')
@section('title') Editar Seccion {{$seccion->nombre_cliente}} @endsection
@section('content')
<form id="formEditarSeccion" method="POST" data-remote="true" action="{{ route('admin.secciones.update', $seccion)}}">
     @csrf
     @method('PUT')
     <input type="hidden" name="parent_id" value="{{$seccion->parent->id}}">
     <input type="hidden" id="rut_cliente" name="rut_cliente" value="{{$seccion->parent->rut_cliente}}">
     <div class="form-group  @error('nombre_cliente') has-danger @enderror">
         <label>Nombre de Sucursal</label>
         <input type="text" class="form-control  @error('nombre_cliente') form-control-danger @enderror"
             id="nombre_cliente" name="nombre_cliente"
             value="{{ old('nombre_cliente', optional($seccion)->nombre_cliente) }}">
         @error('nombre_cliente')
         <small class="form-control-feedback">{{ $message }}</small>
         @enderror
     </div>

     <input type="hidden" id="rut_cliente" name="rut_cliente"
         value="{{ old('rut_cliente', optional($seccion)->rut_cliente)}}">

     <div class="form-group  @error('descripcion_cliente') has-danger @enderror">
         <label>Descripcion</label>
         <textarea class="form-control  @error('descripcion_cliente') form-control-danger @enderror"
             id="descripcion_cliente" name="descripcion_cliente">
                 {{ old('descripcion_cliente', optional($seccion)->descripcion_cliente)}}
             </textarea>
         @error('descripcion')
         <small class="form-control-feedback">{{ $message }}</small>
         @enderror
     </div>
     <div class="form-group  @error('direccion_cliente') has-danger @enderror">
         <label>Dirección</label>
         <input type="text"
             class="form-control  @error('direccion_cliente') form-control-danger @enderror"
             id="direccion_cliente" name="direccion_cliente"
             value="{{ old('direccion_cliente',  optional($seccion)->direccion_cliente)}}">
         @error('direccion_cliente')
         <small class="form-control-feedback">{{ $message }}</small>
         @enderror
     </div>
     <div class="form-group">
        <label for="">Region</label>
        <select class="custom-select" id="region" name="region_cliente" required>
            <option selected>Region</option>
            @foreach ($regiones as $regionsel)
            <option value="{{$regionsel->id}}"
                {{ $provincia->region->id == $regionsel->id ? 'selected' : ''}}>
                {{$regionsel->nombre_region}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Provincia</label>
        <select class="custom-select" id="provincia" name="provincia_cliente" required>
            @foreach ($provinciasdeRegion as $provinciaRegion)
            <option value="{{$provinciaRegion->id}}"
                {{ $provincia->id == $provinciaRegion->id ? 'selected' : ''}}>
                {{$provinciaRegion->nombre_provincia}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Comuna</label>
        <select class="custom-select" id="comuna" name="id_comuna" required>
            @foreach ($comunasdeProvincia as $comunaProvincia)
            <option value="{{$comunaProvincia->id}}"
                {{ $seccion->comuna->id == $comunaProvincia->id ? 'selected' : ''}}>
                {{$comunaProvincia->nombre_comuna}}
            </option>
            @endforeach
        </select>
    </div>
</form>
@endsection
@section('footer')
    <div class="form-group d-flex justify-content-end">
        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" form="formEditarSeccion">Editar
            Sucursal</button>
        <a class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Cancelar</a>
    </div>
@endsection