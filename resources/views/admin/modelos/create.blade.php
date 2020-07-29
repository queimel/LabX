@extends('layouts.modal')
@section('title') Nuevo Modelo {{$marca->nombre_marca}} @endsection
@section('content')
<form id="formCreateModelo" method="POST" action="{{ route('admin.modelos.store')}}" data-remote="true">
     @csrf
    <input type="hidden" name="id_marca_modelo" value="{{$marca->id}}">
    <div class="form-group  @error('nombre_modelo') has-danger @enderror">
        <label for="exampleInputunombre_marca">Nombre de modelo</label>
        <input type="text" class="form-control  @error('nombre_modelo') form-control-danger @enderror" id="nombre_modelo" name="nombre_modelo" value="{{ old('nombre_modelo')}}">
        @error('nombre_modelo')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group  @error('descripcion_modelo') has-danger @enderror">
        <label for="exampleInputunombre_marca">Descripción de modelo</label>
        <textarea class="form-control  @error('descripcion_modelo') form-control-danger @enderror" id="descripcion_modelo" name="descripcion_modelo"  rows="8">
                {{ old('descripcion_modelo')}}
        </textarea>
        @error('descripcion_modelo')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group  @error('frecuencia_modelo') has-danger @enderror">
            <label for="frecuencia_modelo">Frecuencia de mantención modelo</label>
            <input type="number" class="form-control  @error('frecuencia_modelo') form-control-danger @enderror" id="frecuencia_modelo" name="frecuencia_modelo" value="{{ old('frecuencia_modelo')}}" min="0">
            @error('frecuencia_modelo')
            <small class="form-control-feedback">{{ $message }}</small>
            @enderror
        </div>
</form>
@endsection
@section('footer')
    <div class="form-group d-flex justify-content-end">
        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" form="formCreateModelo">Crear Modelo</button>
        <a class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Cancelar</a>
    </div>
@endsection