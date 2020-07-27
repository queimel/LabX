@extends('layouts.modal')
@section('title') Eliminar Sección de sucursal {{$seccion->parent->nombre_cliente}} @endsection
@section('content')
    <h5>¿Estas Seguro de querer eliminar la sección {{$seccion->nombre_cliente}}  ?</h5>
@endsection
@section('footer')
    <form method="POST" action="{{ route('admin.secciones.destroy', $seccion)}}" class="d-inline" data-remote="true">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">
            Eliminar
        </button>
    </form>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
@endsection