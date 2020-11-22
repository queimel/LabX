@extends('layouts.modal')
@section('title') Mantenimiento {{$mantenimiento->equipo->modelo->marca->nombre_marca}} - {{$mantenimiento->equipo->modelo->nombre_modelo}} @endsection
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <small class="text-muted">Fecha de mantenimiento</small>
                <h6>
                    {{date('d-m-Y', strtotime($mantenimiento->fecha_mantenimiento))}}
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">Cliente</small>
                <h6>
                    {{$mantenimiento->equipo->cliente->parent->parent->nombre_cliente}}
                </h6>
                <h6>
                    Sucursal: {{$mantenimiento->equipo->cliente->parent->nombre_cliente}}
                </h6>
                <h6>
                    Seccion: {{$mantenimiento->equipo->cliente->nombre_cliente}}
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">Dirección </small>
                <h6>
                    {{$mantenimiento->equipo->cliente->direccion_cliente}}, {{$mantenimiento->equipo->cliente->comuna->nombre_comuna}}
                </h6>
            </div>
            <div class="card-body">
                <small class="text-muted">Tecnico a cargo </small>
                <h6>
                    {{$mantenimiento->tecnico->user->name}}
                </h6>
                <small class="text-muted">Telefono(s) </small>

                @foreach ($mantenimiento->tecnico->telefonos as $telefono)
                <h6>
                    {{$telefono->numero_telefono}}
                </h6>
                @endforeach
            </div>
            <div class="card-body">
                <h6>Registros actividad</h6>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Fecha</th>
                        <th>Registro</th>
                    </tr>
                    @foreach ($mantenimiento->logs as $log)
                    <tr>
                        <td>{{$log->fecha_log}}</td>
                        <td>{{$log->notas}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Row -->
@endsection
@section('footer')
    <div class="form-group d-flex justify-content-end">
        <button class="btn btn-inverse waves-effect waves-light" data-dismiss="modal">Cerrar</button>
    </div>
@endsection
