
@extends('layouts.modal')
@section('title') Editar Modelo @endsection
@section('content')
<form class="form "  id="formEdicionModelo" method="POST" action="{{ route('admin.modelos.update', $modelo)}}" data-remote="true">
    @csrf
    @method('PUT')
    <div class="form-group @error('id_marca_modelo') has-danger @enderror">
        <label class="control-label">Marca de modelo</label>
        <select class="custom-select" name="id_marca_modelo">
            @foreach ($marcas as $marca)
                <option
                value="{{$marca->id}}"
                {{ $marca->id == $modelo->marca->id ? 'selected' : ''}}
                >{{$marca->nombre_marca}}
            </option>
            @endforeach
        </select>
        @error('id_marca_modelo')
        <small class="form-control-feedback d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group  @error('nombre_modelo') has-danger @enderror">
        <label for="exampleInputunombre_marca">Nombre de modelo</label>
        <input type="text" class="form-control  @error('nombre_modelo') form-control-danger @enderror" id="nombre_modelo" name="nombre_modelo" value="{{ old('nombre_modelo', optional($modelo)->nombre_modelo)}}">
        @error('nombre_modelo')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group  @error('descripcion_modelo') has-danger @enderror">
        <label for="exampleInputunombre_marca">Descripción de modelo</label>
        <textarea class="form-control  @error('descripcion_modelo') form-control-danger @enderror" id="descripcion_modelo" name="descripcion_modelo"  rows="8">
                {{ old('descripcion_modelo', optional($modelo)->descripcion_modelo)}}
        </textarea>
        @error('descripcion_modelo')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group  @error('frecuencia_modelo') has-danger @enderror">
        <label for="frecuencia_modelo">Frecuencia de mantención modelo</label>
        <input type="number" class="form-control  @error('frecuencia_modelo') form-control-danger @enderror" id="frecuencia_modelo" name="frecuencia_modelo" value="{{ old('frecuencia_modelo', optional($modelo)->frecuencia_modelo)}}">
        @error('frecuencia_modelo')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>
</form>
@endsection
@section('footer')
    <div class="form-group d-flex justify-content-end">
        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" form="formEdicionModelo">Editar Modelo</button>
        <a class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Cancelar</a>
    </div>
@endsection