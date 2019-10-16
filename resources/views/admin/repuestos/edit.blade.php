@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Editar repuesto</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.repuestos.index')}}">Repuestos</a></li>
            <li class="breadcrumb-item active">Editar repuesto</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.repuestos.update', $repuesto)}}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group  @error('nombre_repuesto') has-danger @enderror">
                        <label>Nombre de repuesto</label>
                        <input type="text" class="form-control @error('nombre_repuesto') form-control-danger @enderror" id="nombre_repuesto" name="nombre_repuesto" value="{{ old('nombre_repuesto', optional($repuesto)->nombre_repuesto) }}">

                        @error('nombre_repuesto')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group  @error('nivel_repuesto') has-danger @enderror">
                        <label>Nivel de repuesto</label>
                        <input type="number" class="form-control @error('nivel_repuesto') form-control-danger @enderror" id="nivel_repuesto" name="nivel_repuesto" value="{{ old('nivel_repuesto', optional($repuesto)->nivel_repuesto) }}" min = 1 max = 4>

                        @error('nivel_repuesto')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Editar repuesto</button>
                        <a class="btn btn-inverse waves-effect waves-light" href="{{ URL::previous() }}">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Row -->

@endsection
