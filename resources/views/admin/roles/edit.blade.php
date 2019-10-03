@extends('layouts.app')


@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Editar Rol</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.roles.index')}}">Roles</a></li>
            <li class="breadcrumb-item active">Editar Roles y permisos</li>
        </ol>
    </div>
</div>
@endpush

@section('content')
<!-- Row -->

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <form class="form p-t-20" method="POST" action="{{ route('admin.roles.update', $rol)}}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <h5>Crear Rol</h5>
                        <hr>
                        <div class="form-group  @error('name') has-danger @enderror">
                            <label for="exampleInputuname">Nombre de rol</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-user"></i></div>
                                <input type="text" class="form-control  @error('name') form-control-danger @enderror" id="name" name="name" value="{{ old('name', optional($rol)->name) }}">
                            </div>
                            @error('name')
                            <small class="form-control-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group @error('permissions') has-danger @enderror">
                            <label class="control-label">Permisos</label>
                            <select multiple id="public-methods" name="permissions[]">
                                @foreach ($permissions as $permission)
                                    <option value="{{$permission->id}}"
                                        {{ $rol->getAllPermissions()->contains($permission->id) ? 'selected' : ''}}
                                    >{{$permission->name}}</option>
                                @endforeach

                                </select>
                            @error('permissions')
                            <small class="form-control-feedback d-block">{{ $message }}</small>
                            @enderror
                        </div>
                        <hr>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Editar Rol</button>
                            <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancelar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

<!-- Row -->

@endsection

@push('styles')
    <link href="{{asset('js/plugins/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('js/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/multiselect/js/jquery.multi-select.js')}}" defer></script>

<script>
jQuery(document).ready(function() {
    jQuery('#public-methods').multiSelect();
});

</script>

@endpush
