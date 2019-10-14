@extends('layouts.app')


@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Crear Marca</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.equipos.marcas.index')}}">Marcas</a></li>
            <li class="breadcrumb-item active">Nueva marca</li>
        </ol>
    </div>
</div>
@endpush

@section('content')
<!-- Row -->

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <form class="form p-t-20" method="POST" action="{{ route('admin.equipos.marcas.store')}}">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group  @error('nombre_marca') has-danger @enderror">
                            <label for="exampleInputunombre_marca">Nombre de marca</label>
                            <input type="text" class="form-control  @error('nombre_marca') form-control-danger @enderror" id="nombre_marca" name="nombre_marca" value="{{ old('nombre_marca')}}">
                            @error('nombre_marca')
                            <small class="form-control-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group @error('origen_marca') has-danger @enderror">
                            <label class="control-label">Origen</label>
                            <select class="custom-select" name="origen_marca">
                                @foreach ($paises as $pais)
                                    <option value="{{$pais->id}}">{{$pais->name}}</option>
                                @endforeach
                            </select>
                            @error('origen_marca')
                            <small class="form-control-feedback d-block">{{ $message }}</small>
                            @enderror
                        </div>
                        <hr>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Crear Marca</button>
                            <a class="btn btn-inverse waves-effect waves-light" href="{{ URL::previous() }}">Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

<!-- Row -->

@endsection

@push('styles')

@endpush

@push('scripts')


@endpush
