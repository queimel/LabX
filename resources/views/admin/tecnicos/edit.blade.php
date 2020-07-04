@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Crear Técnico</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.tecnicos.update', $tecnico)}}">Técnicos</a></li>
            <li class="breadcrumb-item active">Editar técnico</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- Row -->
<form class="form p-t-20" method="POST" action="{{ route('admin.tecnicos.update', $tecnico)}}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edita los datos del técnico</h4>
                    <hr>
                    <div class="form-group  @error('nombre_tecnico') has-danger @enderror">
                        <label>Nombres de técnico</label>
                        <input type="text" class="form-control @error('nombre_tecnico') form-control-danger @enderror" id="nombre_tecnico" name="nombre_tecnico" value="{{ old('nombre_tecnico', optional($tecnico)->nombre_tecnico)}}">
                        @error('nombre_tecnico')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group  @error('apellido_tecnico') has-danger @enderror">
                        <label>Apellidos de técnico</label>
                        <input type="text" class="form-control @error('apellido_tecnico') form-control-danger @enderror" id="apellido_tecnico" name="apellido_tecnico" value="{{ old('apellido_tecnico', optional($tecnico)->apellido_tecnico)}}">
                        @error('apellido_tecnico')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group  @error('run_tecnico') has-danger @enderror">
                        <label>RUN de técnico</label>
                        <input type="text" class="form-control @error('run_tecnico') form-control-danger @enderror" id="run_tecnico" name="run_tecnico" value="{{ old('run_tecnico', optional($tecnico)->run_tecnico)}}">
                        @error('run_tecnico')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    
                        <label>Telefonos</label>
                        <div id="telefonos">
                        @foreach ($telefonos as $telefono)
                            
                                <div class="form-group  @error('telefono_tecnico_{{$loop->index}}') has-danger @enderror">
                                    <div class="input-group">
                                        <input 
                                            type="text" 
                                            class="form-control @error('telefonos_tecnico_{{$loop->index}}') form-control-danger @enderror" 
                                            id="telefonos_tecnico_{{$loop->index}}" 
                                            name="telefonos_tecnico[]" 
                                            value="{{ old('telefonos_tecnico_$loop->index', optional($tecnico)->telefonos[$loop->index]->numero_telefono)}}"
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
                    

                    <div class="form-group @error('supervisor_id') has-danger @enderror">
                        <label for="">Supervisor</label>
                        <select class="custom-select @error('supervisor_id') form-control-danger @enderror" id="marca" name="supervisor_id">
                            <option selected>Supervisor</option>
                                @foreach ($supervisores as $supervisor)
                                <option
                                    value="{{$supervisor->id}}"

                                    {{ old('supervisor_id') == $supervisor->id ? 'selected' : '' }}
                                >
                                {{$supervisor->nombre_tecnico}} {{$supervisor->apellido_tecnico}}
                                </option>
                                @endforeach
                        </select>
                        @error('supervisor_id')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                        <small>No selecccionar si el técnico que editará es un supervisor.</small>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Editar Técnico</button>
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

