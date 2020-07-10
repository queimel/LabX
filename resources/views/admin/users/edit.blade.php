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
                        @if ($user->esTecnico())
                        <div class="form-group @error('run_tecnico') has-danger @enderror">
                            <label for="exampleInputEmail1">RUN</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-id-badge"></i></div>
                                <input type="text" class="form-control @error('email') form-control-danger @enderror" id="run_tecnico" name="run_tecnico" value="{{ old('run_tecnico', optional($user)->profile->run_tecnico) }}">
                            </div>
                            @error('email')
                            <small class="form-control-feedback d-block">{{ $message }}</small>
                            @enderror
                        </div>                            
                        @endif
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

                        @if ($user->esTecnico())
                        <label>Teléfonos</label>
                        <div id="telefonos">
                        @foreach ($user->profile->telefonos as $telefono)
                            <div class="form-group  @error('telefono_tecnico_{{$loop->index}}') has-danger @enderror">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-mobile"></i></div>
                                    <input 
                                        type="text" 
                                        class="form-control @error('telefonos_tecnico_{{$loop->index}}') form-control-danger @enderror" 
                                        id="telefonos_tecnico_{{$loop->index}}" 
                                        name="telefonos_tecnico[]" 
                                        value="{{ old('telefonos_tecnico_$loop->index', optional($user->profile)->telefonos[$loop->index]->numero_telefono)}}"
                                    >
                                    @if (!$loop->first)
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger removePhone" type="button" data-toggle="modal" data-target="#exampleModal" onclick="deleteData({{$telefono->id}})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </span>
                                    @endif
                                    <span class="input-group-btn">
                                        <button class="btn btn-info addPhone" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                    
                                </div>
                                @error('telefonos_tecnico_{{$loop->index}}')
                                <small class="form-control-feedback">{{ $message }}</small>
                                @enderror
                                <input type="hidden"  id="telefonos_tecnico_id_{{$loop->index}}"  name="telefonos_tecnico_id[]" value="{{ $telefono->id}}">
                            </div>
                        @endforeach
                        </div> 
                        @endif


                        <div class="form-group @error('password') has-danger @enderror">
                            <label for="pwd1">Contraseña</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-lock"></i></div>
                                <input type="password" class="form-control @error('password') form-control-danger @enderror" id="pwd1" name="password" placeholder="Contraseña">
                            </div>

                            @error('password')
                            <small class="form-control-feedback d-block">{{ $message }}</small>
                            @enderror
                            <div class="d-flex justify-content-between">
                                <small class="help-block d-block">Dejar en blanco si no quieres cambiar la contraseña</small>
                                <small data-toggle="tooltip" class="form-text text-muted text-right" data-placement="right"
                                    title="Debe contener a lo menos un carácter en minúscula, uno en mayúscula, un numero, un carácter especial y el largo debe ser mayor o igual a 8">
                                    Formato
                                    <i class="fa fa-question-circle"></i>
                                </small>
                            </div>

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
                        <a class="btn btn-inverse waves-effect waves-light" href="{{ URL::previous() }}">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Row -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Telefono de Tecnico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>¿Estas Seguro de querer eliminar este telefono?</h5>
            </div>
            <div class="modal-footer">


                <form method="POST" action="" class="d-inline" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" onclick="formSubmit()">
                        Eliminar
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/plugins/jquery/jquery.min.js')}}"></script>
<script>
    $(document).ready(function() {
        
        $('#telefonos').on('click', '.addPhone', function(){
            console.log('click');
            var size =  $('#telefonos').children().length;
            var input = `
                <div class="form-group  @error('telefono_tecnico_${size}') has-danger @enderror">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="ti-mobile"></i></div>
                        <input 
                            type="text" 
                            class="form-control @error('telefonos_tecnico_${size}') form-control-danger @enderror" 
                            id="telefonos_tecnico_${size}" 
                            name="telefonos_tecnico[]" 
                            value=""
                        >
                        <span class="input-group-btn">
                            <button class="btn btn-danger removeNewPhone" type="button">
                                <i class="fa fa-trash"></i>
                            </button>
                        </span>
                        <span class="input-group-btn">
                            <button class="btn btn-info addPhone" type="button">+</button>
                        </span>
                        
                    </div>
                    @error('telefonos_tecnico_${size}')
                    <small class="form-control-feedback">{{ $message }}</small>
                    @enderror
                    <input type="hidden"  id="telefonos_tecnico_id_${size}"  name="telefonos_tecnico_id[]" value="">
                </div>
            `

            $('#telefonos').append(input);
        });

        $('#telefonos').on('click', '.removeNewPhone', function(){
            console.log(this);
            $(this).parent().parent().parent().remove();
        });



    });

    function deleteData(id)
        {
            var id = id;
            var url =  {{config('url')}}'/admin/telefono/'+id;
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
</script>
@endpush