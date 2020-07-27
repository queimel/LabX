@extends('layouts.modal')
@section('title') Edita los datos de la Sucursal @endsection
@section('content')
<form  id="modal-form" data-remote="true" method="POST" action="{{ route('admin.sucursales.update', $sucursal)}}">
    @csrf
    @method('PUT')
    <input type="hidden" id="id" name="id" value="{{$sucursal->id}}">
    <div class="form-group  @error('nombre_cliente') has-danger @enderror">
        <label>Nombre de Sucursal</label>
        <input type="text" class="form-control  @error('nombre_cliente') form-control-danger @enderror"
            id="nombre_cliente" name="nombre_cliente"
            value="{{ old('nombre_cliente', optional($sucursal)->nombre_cliente) }}">
        @error('nombre_cliente')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>

    <input type="hidden" id="rut_cliente" name="rut_cliente"
        value="{{ old('rut_cliente', optional($sucursal)->rut_cliente)}}">

    <div class="form-group  @error('descripcion_cliente') has-danger @enderror">
        <label>Descripcion</label>
        <textarea class="form-control  @error('descripcion_cliente') form-control-danger @enderror"
            id="descripcion_cliente" name="descripcion_cliente">
                {{ old('descripcion_cliente', optional($sucursal)->descripcion_cliente)}}
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
            value="{{ old('direccion_cliente',  optional($sucursal)->direccion_cliente)}}">
        @error('direccion_cliente')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="">Region</label>
        <select class="custom-select" id="region-sucursal" name="region_cliente" required>
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
        <select class="custom-select" id="provincia-sucursal" name="provincia_cliente" required>
            @foreach ($provinciasdeRegion as $provinciaRegion)
            <option value="{{$provinciaRegion->id}}"
                {{ $provincia->id == $provinciaRegion->id ? 'selected' : ''}}>
                {{$provinciaRegion->nombre_provincia}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Comuna</label>
        <select class="custom-select" id="comuna-sucursal" name="id_comuna" required>
            @foreach ($comunasdeProvincia as $comunaProvincia)
            <option value="{{$comunaProvincia->id}}"
                {{ $sucursal->comuna->id == $comunaProvincia->id ? 'selected' : ''}}>
                {{$comunaProvincia->nombre_comuna}}
            </option>
            @endforeach
        </select>
    </div>
</form>
@endsection
@section('footer')
    <div class="form-group d-flex justify-content-end">
        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" form="modal-form">Editar
            Sucursal</button>
        <a class="btn btn-inverse waves-effect waves-light" id="closeBtn">Cancelar</a>
    </div>
@endsection

@push('modal-scripts')
<script>
    $(document).ready(function(){
        $("#modal").on('change', '#region-sucursal',function(){
            var region = $(this).val();
            $.get({{config('url')}}'/admin/provinciasPorRegion/'+region, function(data){
                var provincias_select = '<option value="">Seleccione Provincia</option>'
                    for (var i=0; i<data.length;i++)
                    provincias_select+='<option value="'+data[i].id+'">'+data[i].nombre_provincia+'</option>';

                    $("#provincia-sucursal").html(provincias_select).removeAttr('disabled');
            });
        });

        $("#modal").on('change', '#provincia-sucursal', function(){
            var provincia = $(this).val();
            $.get({{config('url')}}'/admin/comunasPorProvincia/'+provincia, function(data){
                var comunas_select = '<option value="">Seleccione Comuna</option>'
                    for (var i=0; i<data.length;i++)
                    comunas_select+='<option value="'+data[i].id+'">'+data[i].nombre_comuna+'</option>';

                    $("#comuna-sucursal").html(comunas_select).removeAttr('disabled');
            });
        });
    });
</script>
@endpush 