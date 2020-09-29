@extends('layouts.app')


@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Crear usuario</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.usuarios.index')}}">Usuarios</a></li>
            <li class="breadcrumb-item active">Crear usuario</li>
        </ol>
    </div>
</div>
@endpush

@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.usuarios.store')}}">
    @csrf
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <div class="card-body">
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
                        <div id="run_tecnico" style="display:none;">
                            <div class="form-group @error('run_tecnico') has-danger @enderror">
                                <label for="exampleInputEmail1">RUN</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-id-badge"></i></div>
                                    <input type="text" class="form-control @error('email') form-control-danger @enderror" id="run_tecnico" name="run_tecnico" value="">
                                </div>
                                @error('run_tecnico')
                                <small class="form-control-feedback d-block">{{ $message }}</small>
                                @enderror
                            </div>  
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


                        <div id="telefonos_tecnico" style="display:none;">
                            <label>Teléfonos</label>
                            <div id="telefonos">
    
                                <div class="form-group  @error('telefono_tecnico') has-danger @enderror">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="ti-mobile"></i></div>
                                        <input 
                                            type="text" 
                                            class="form-control @error('telefonos_tecnico_1') form-control-danger @enderror" 
                                            id="telefonos_tecnico" 
                                            name="telefonos_tecnico[]" 
                                            value=""
                                        >
                                        <span class="input-group-btn">
                                            <button class="btn btn-info addPhone" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </span>
                                        
                                    </div>
                                    @error('telefonos_tecnico_1')
                                    <small class="form-control-feedback">{{ $message }}</small>
                                    @enderror
                                    <input type="hidden"  id="telefonos_tecnico_id_1"  name="telefonos_tecnico_id[]" value="">
                                </div>
                            </div> 
                        </div>

                        <div id="clientes_encargado" style="display:none;">
                            <!-- select clientes casas matrices -->
                            <div class="form-group @error('casa_matriz') has-danger @enderror">
                                <label for="">Cliente</label>
                        
                                <select class="custom-select @error('casa_matriz') form-control-danger @enderror" id="casa_matriz" name="casa_matriz">
                                    <option value="">Seleccionar</option>
                                    @foreach ($clientes as $cliente) 
                                        <option
                                            value="{{ $cliente->id}}"
                                        >
                                            {{$cliente->nombre_cliente}}
                                        </option>
                                    @endforeach
                                </option>
                                </select>
                                @error('casa_matriz')
                                <small class="form-control-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- select clientes sucursales -->
                            <div class="form-group @error('sucursal_encargado') has-danger @enderror">
                                <label for="">Sucursal</label>
                        
                                <select class="custom-select @error('sucursal_encargado') form-control-danger @enderror" id="sucursal_encargado" name="sucursal_encargado" disabled>
                                    
                                </select>
                                @error('sucursal_encargado')
                                <small class="form-control-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!--select clientes secciones sucursales -->
                            <div class="form-group @error('id_cliente_encargado') has-danger @enderror">
                                <label for="">Secciones</label>
                        
                                <select class="custom-select @error('id_cliente_encargado') form-control-danger @enderror" id="id_cliente_encargado" name="id_cliente_encargado" disabled>
                                </select>
                                @error('id_cliente_encargado')
                                <small class="form-control-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group">
                            <small>La contraseña se generará de forma automatica</small>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
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
                                        name="roles[]" 
                                        class="roles_check" 
                                        type="radio" 
                                        value="{{$rol->name}}" 
                                        id="role_{{$rol->id}}" 
                                        @if ($loop->first) checked="checked" @endif 
                                        data-role="{{$rol->name}}"
                                        >
                                    <label for="role_{{$rol->id}}">{{$rol->name}}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('roles')
                        <small class="form-control-feedback d-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Crear Usuario</button>
                        <a class="btn btn-inverse waves-effect waves-light" href="{{ URL::previous() }}">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Row -->

@endsection

@push('scripts')
<script src="{{ asset('js/plugins/jquery/jquery.min.js')}}"></script>
<script>
    $(document).ready(function() {
        

        $('body').on('click', '.roles_check', function(){
            if($(this).data('role') === 'Tecnico'){
                $('#telefonos_tecnico').show(); 
                $('#run_tecnico').show(); 
                $('#clientes_encargado').hide();                                 
            }else if($(this).data('role') === 'Encargado'){
                $('#clientes_encargado').show();
            }else{
                $('#telefonos_tecnico').hide();
                $('#run_tecnico').hide();
                $('#clientes_encargado').hide();
            }
        });


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
            $(this).parent().parent().parent().remove();
        });

        $("#casa_matriz").change(function(){
            var cliente = $(this).val();
            getSucursales(cliente, '#sucursal_encargado', 'sucursal');
            $('#id_cliente_encargado').attr('disabled', 'disabled');
            $('#id_cliente_encargado').html('');
        });

        $("#sucursal_encargado").change(function(){
            var cliente = $(this).val();
            getSucursales(cliente, '#id_cliente_encargado', 'seccion');
        });

    });

    function getSucursales(cliente, dropdown, tipo){
        getClients(cliente, dropdown, tipo)
    }

    function getSecciones(cliente, dropdown, tipo){
        getClients(cliente, dropdown, tipo)
    }

    function getClients(cliente, dropdown, tipo){
        $.get({{config('url')}}'/admin/sucursales_cliente/'+cliente, function(data){
            var sucursales_select = `<option value="">Seleccione ${tipo}</option>`;
            for (var i=0; i<data.length;i++){
                sucursales_select+='<option value="'+data[i].id+'">'+data[i].nombre_cliente+'</option>'       
            };
            $(dropdown).html(sucursales_select).removeAttr('disabled');
        });
    }
</script>
@endpush