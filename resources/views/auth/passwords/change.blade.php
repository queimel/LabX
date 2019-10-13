@extends('layouts.login')

@section('content')
@if ($expired)
    <h3 class="box-title m-b-10">Tu contraseña ha expirado</h3>
    <h6 class="m-b-20">Debes cambiar tu contraseña</h6>
@else
    <h3 class="box-title m-b-20">Cambia tu contraseña</h3>
@endif

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
<a href="{{ route('dashboard')}}">Ir al dashboard</a>
@else
<form id="loginform" method="POST" action="{{ route('password.post_change') }}">
    @csrf
    <div class="form-group">
        <div class="col-xs-12">

            <input id="current_password" type="password"
                class="form-control @error('current_password') is-invalid @enderror" name="current_password"
                placeholder="Contraseña Actual">
            @error('currrent_password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" placeholder="Nueva contraseña">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <small data-toggle="tooltip"
                class="form-text text-muted text-right"
                data-placement="right"
                title="Debe contener a lo menos un carácter en minúscula, uno en mayúscula, un numero, un carácter especial y el largo debe ser mayor o igual a 8">
                Formato
                <i class="fa fa-question-circle"></i>
            </small>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            <input id="password_confirmation" type="password"
                class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                placeholder="Confirmar nueva contraseña">
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group text-center">
        <div class="col-xs-12 p-b-20">
            <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Cambiar password</button>
        </div>
    </div>
</form>
@endif
@endsection
