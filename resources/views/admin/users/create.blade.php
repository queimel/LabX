@extends('layouts.app')
@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.usuarios.store')}}">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Crear Usuario</h4>
                        <div class="form-group  @error('name') has-danger @enderror">
                            <label for="exampleInputuname">Nombre de usuario</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-user"></i></div>
                                <input type="text" class="form-control  @error('name') form-control-danger @enderror" id="name" name="name" value="{{ old('name')}}">
                            </div>
                            @error('name')
                            <small class="form-control-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group @error('email') has-danger @enderror">
                            <label for="exampleInputEmail1">Email</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-email"></i></div>
                                <input type="email" class="form-control @error('email') form-control-danger @enderror" id="email" name="email" value="{{ old('email')}}">
                            </div>
                            @error('email')
                            <small class="form-control-feedback d-block">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <small>La contraseña se generará de forma automatica</small>
                        </div>

                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Crear Usuario</button>
                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancelar</button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Roles y permisos</h4>
                    <hr>
                    <div class="form-group @error('roles') has-danger @enderror">
                        <label class="control-label">Roles</label>

                        <div class="d-flex justify-content-between">
                            @foreach ($roles as $rol)
                                <div>
                                    <input
                                        type="checkbox"
                                        id="basic_checkbox_{{$rol->id}}"
                                        class="filled-in"
                                        value="{{$rol->id}}"
                                        name="roles[]"
                                    >
                                    <label for="basic_checkbox_{{$rol->id}}">{{$rol->name}}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('roles')
                        <small class="form-control-feedback d-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Row -->

@endsection
