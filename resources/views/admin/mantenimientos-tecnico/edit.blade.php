@extends('layouts.modal')
@section('title') Editar Mantención @endsection
@section('content')
<form class="form p-t-20" id="formCrearMantencion" method="POST" action="{{ route('admin.mantenimientos-tecnico.update', $mantenimiento->id)}}" data-remote="true">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @method('PUT')
                    <h4 class="card-title">Estado</h4>
                    <hr>
                    <input type="hidden" name="id_tecnico_mantenimiento" value="{{ old('id_tecnico_mantenimiento', optional($mantenimiento)->tecnico->id) }}">
                    <div class="form-group">
                        <div class="demo-radio-button">
                            <input name="status" type="radio" id="radio_1" value="1" {{ $mantenimiento->status === 1 ? 'checked' : ''}}/>
                            <label for="radio_1">Abierto</label>
                            <input name="status" type="radio" id="radio_2" value="0" {{ $mantenimiento->status === 0 ? 'checked' : ''}}/>
                            <label for="radio_2">Cerrado</label>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Equipo</label>
                        {{$mantenimiento->equipo->modelo->nombre_modelo}}
                        <input type="hidden" name="id_equipo_mantenimiento" value="{{ old('id_equipo_mantenimiento', optional($mantenimiento)->equipo->id) }}">
                    </div>                   

                    <!-- input marca equipo disabled -->
                   <div class="form-group">
                        <label>Marca equipo</label>
                        {{$mantenimiento->equipo->modelo->marca->nombre_marca}}
                    </div> 

                     <div class="form-group  @error('mantenimiento_equipo_num_serie') has-danger @enderror">
                        <label>Número de serie equipo</label>
                        {{$mantenimiento->equipo->num_serie_equipo}}
                    </div>
                    <div class="form-group" @error('fecha_mantenimiento') has-danger @enderror>
                        <label>Fecha mantenimiento</label>
                        {{$fecha_mantenimiento}}
                    </div>
                    @if (count($mantenimiento->logs) > 0)
                        <h6>Registros actividad</h6>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Fecha</th>
                                <th>Registro</th>
                                <th></th>
                            </tr>
                            @foreach ($mantenimiento->logs as $log)
                            <tr>
                                <td>{{$log->fecha_log}}</td>
                                <td>{{$log->notas}}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </table>                        
                    @endif
                    <div class="form-group" @error('log_mantenimiento') has-danger @enderror>
                        <label>Agregar log</label>
                        <textarea 
                            class="form-control 
                            @error('log_mantenimiento') has-danger @enderror" 
                            id="log_mantenimiento" 
                            name="log_mantenimiento"
                            value="{{ old('log_mantenimiento') }}">
                        </textarea>
                        @error('log_mantenimiento')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
<!-- Row -->

@endsection
@section('footer')
    <div class="form-group d-flex justify-content-end">
        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" form="formCrearMantencion">Editar Mantenimiento</button>
        <a class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Cancelar</a>
    </div>
@endsection

@push('modal-scripts')


@endpush

@push('styles')

@endpush