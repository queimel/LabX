@extends('layouts.modal')
@section('title') Eliminar Sucursal @endsection
@section('content')
    <h5>¿Estas Seguro de querer el modelo {{$modelo->nombre_modelo}}  ?</h5>
@endsection
@section('footer')
    <form method="POST" action="{{ route('admin.modelos.destroy', $modelo)}}" class="d-inline" data-remote="true">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">
            Eliminar
        </button>
    </form>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
@endsection