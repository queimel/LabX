@extends('layouts.modal')
@section('title') Nueva Marca @endsection
@section('content')
<form method="POST" id="formCreacionMarca" action="{{ route('admin.marcas.store')}}" data-remote="true">
     @csrf
     <div class="form-group  @error('nombre_marca') has-danger @enderror">
        <label for="exampleInputunombre_marca">Nombre de marca</label>
        <input type="text" class="form-control  @error('nombre_marca') form-control-danger @enderror" id="nombre_marca" name="nombre_marca" value="{{ old('nombre_marca')}}">
        @error('nombre_marca')
        <small class="form-control-feedback">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group @error('origen_marca') has-danger @enderror">
        <label class="control-label">Origen</label>
        <select class="custom-select" name="origen_marca">
            @foreach ($paises as $pais)
                <option value="{{$pais->id}}">{{$pais->name}}</option>
            @endforeach
        </select>
        @error('origen_marca')
        <small class="form-control-feedback d-block">{{ $message }}</small>
        @enderror
    </div>
</form>
@endsection
@section('footer')
    <div class="form-group d-flex justify-content-end">
        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" form="formCreacionMarca">Crear Marca</button>
        <a class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Cancelar</a>
    </div>
@endsection