@extends('layouts.login')

@section('content')
<div class="text-center">
    <h1>Usuario no autorizado</h1>
    <h5 class="m-b-40">Por favor comuniquese con el administrador</h5>
    <a href="{{ url('/') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
