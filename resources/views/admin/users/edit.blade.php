@extends('layouts.app')
@section('content')
<!-- Row -->
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Editar Usuario</h4>
                <form class="form p-t-20" method="POST" action="{{ route('admin.usuarios.update', $user)}}">
                    @csrf
                    @method('PUT')
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

                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Actualizar Usuario</button>
                    <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Row -->
@endsection
