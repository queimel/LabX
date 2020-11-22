@extends('layouts.modal')
@section('title') Crear Mantención @endsection
@section('content')
<form class="form p-t-20" id="formCrearMantencion" method="POST" action="{{ route('admin.mantenimientos-cliente.store')}}" data-remote="true">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- equipo de cliente -->
                    <div class="form-group @error('id_equipo_mantenimiento') has-danger @enderror">
                        <label for="">Equipo</label>
                        <select class="custom-select @error('id_equipo_mantenimiento') form-control-danger @enderror" id="id_equipo_mantenimiento" name="id_equipo_mantenimiento"  required>
                            @foreach ($equipos as $equipo) 
                                <option value = {{ $equipo->id}}>
                                    {{$equipo->modelo->marca->nombre_marca}} - {{$equipo->modelo->nombre_modelo}}
                                </option>
                            @endforeach
                        </select>
                        @error('id_equipo_mantenimiento')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Fecha mantenimiento</label>
                        <input type="date" class="form-control @error('fecha_mantenimiento') has-danger @enderror" id="fecha_mantenimiento" name="fecha_mantenimiento" value="" min="2000-01-01" max="">

                        @error('fecha_mantenimiento')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Notas</label>
                        <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
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
        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" form="formCrearMantencion">Crear Mantenimiento</button>
        <a class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Cancelar</a>
    </div>
@endsection