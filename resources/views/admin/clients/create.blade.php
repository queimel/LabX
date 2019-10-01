@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Crear Cliente</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.clientes.index')}}">Clientes</a></li>
            <li class="breadcrumb-item active">Crear cliente</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.clientes.store')}}">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Crear Cliente</h4>
                    <hr>
                    <div class="form-group  @error('name') has-danger @enderror">
                        <label for="exampleInputuname">Nombre de Cliente</label>
                        <input type="text" class="form-control  @error('name') form-control-danger @enderror" id="name" name="name" value="{{ old('name')}}">
                        @error('name')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group  @error('rut') has-danger @enderror">
                        <label for="exampleInputuname">RUT de Cliente</label>
                        <input type="text" class="form-control  @error('rut') form-control-danger @enderror" id="rut" name="rut" value="{{ old('rut')}}">
                        @error('rut')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Crear Cliente</button>
                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Row -->

@endsection
