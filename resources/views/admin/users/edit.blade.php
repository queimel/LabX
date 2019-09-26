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
                            <input type="email" class="form-control @error('email') form-control-danger @enderror" id="email" name="email" value="{{ old('name', optional($user)->email) }}">
                        </div>
                        @error('email')
                        <small class="form-control-feedback d-block">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="pwd1">Password</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="ti-lock"></i></div>
                            <input type="password" class="form-control" id="pwd1" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pwd2">Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="ti-lock"></i></div>
                            <input type="password" class="form-control" id="pwd2" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox checkbox-success">
                            <input id="checkbox1" type="checkbox">
                            <label for="checkbox1"> Remember me </label>
                        </div>
                    </div> --}}
                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Actualizar Usuario</button>
                    <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Row -->
@endsection
