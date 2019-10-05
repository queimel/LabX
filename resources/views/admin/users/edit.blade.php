@extends('layouts.app')

@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Editar usuario</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.usuarios.index')}}">Usuarios</a></li>
            <li class="breadcrumb-item active">Editar usuario</li>
        </ol>
    </div>
</div>
@endpush

@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.usuarios.update', $user)}}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                        <div class="form-group  @error('name') has-danger @enderror">
                            <label for="exampleInputuname">Nombre de usuario</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-user"></i></div>
                                <input type="text" class="form-control  @error('name') form-control-danger @enderror" id="name" name="name" value="{{ old('name', optional($user)->name) }}">
                            </div>
                            @error('name')
                            <small class="form-control-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group @error('email') has-danger @enderror">
                            <label for="exampleInputEmail1">Email</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-email"></i></div>
                                <input type="email" class="form-control @error('email') form-control-danger @enderror" id="email" name="email" value="{{ old('email', optional($user)->email) }}">
                            </div>
                            @error('email')
                            <small class="form-control-feedback d-block">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group @error('password') has-danger @enderror">
                            <label for="pwd1">Contraseña</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-lock"></i></div>
                                <input type="password" class="form-control @error('password') form-control-danger @enderror" id="pwd1" name="password" placeholder="Contraseña">
                            </div>

                            @error('password')
                            <small class="form-control-feedback d-block">{{ $message }}</small>
                            @enderror
                            <small class="help-block d-block">Dejar en blanco si no quieres cambiar la contraseña</small>
                        </div>
                        <div class="form-group @error('password_confirmation') has-danger @enderror">
                            <label for="pwd2">Confirmar contraseña</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-lock"></i></div>
                                <input type="password" class="form-control @error('password_confirmation') form-control-danger @enderror" id="pwd2" name="password_confirmation" placeholder="Repite la contraseña">
                            </div>

                            @error('password_confirmation')
                            <small class="form-control-feedback d-block">{{ $message }}</small>
                            @enderror
                        </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Roles y permisos</h4>
                    <hr>
                    <div class="form-group">

                        <div class="d-flex justify-content-between">
                            @foreach ($roles as $rol)
                                <div>
                                    <input
                                        type="checkbox"
                                        id="basic_checkbox_{{$rol->id}}"
                                        class="filled-in"
                                        {{ $user->roles->contains($rol->id) ? 'checked' : ''}}
                                        value="{{$rol->id}}"
                                        name="roles[]"
                                        @unlessrole('Admin') disabled @endunlessrole
                                    >
                                    <label for="basic_checkbox_{{$rol->id}}">{{$rol->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Estado</label>
                        <div class="demo-radio-button">
                            <input name="active" type="radio" id="radio_1" value="true" {{ $user->active === 1 ? 'checked' : ''}}/>
                            <label for="radio_1">Habilitado</label>
                            <input name="active" type="radio" id="radio_2" value="false" {{ $user->active === 0 ? 'checked' : ''}}/>
                            <label for="radio_2">Deshabilitado</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Actualizar Usuario</button>
                        <button class="btn btn-inverse waves-effect waves-light">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Row -->
@endsection
