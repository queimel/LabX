@extends('layouts.app')

@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Listado de Clientes</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Clientes</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive m-t-40">
                    <table id="usersTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Número de serie</th>
                                <th>Test</th>
                                <th>Fecha mantención</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($equipos as $equipo)
                            <tr>
                                <td>
                                    <script>
                                        function(){
                                            var region = $(this).val();
                                            $.get({{config('url')}}'/admin/modeloPorEquipo/'+equipo, function(data){
                                                var region = data[i] = nombre_region;
                                            });
                                        });
                                        document.write();
                                    </script>
                                </td>
                                <td></td>
                                <td>
                                    {{$equipo->num_serie_equipo}}
                                </td>
                                <td>
                                    {{$equipo->test_equipo}}
                                </td>
                                <td>
                                    {{$equipo->fecha_ultima_mantencion_equipo}}
                                </td>
                                <td>
                                    <a class="btn btn-default btn-xs" href="{{ route('admin.equipos.show', $equipo)}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-primary btn-xs" href="{{ route('admin.equipos.edit', $equipo)}}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <!-- <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" onclick="deleteData({{$equipo->id}})">
                                        <i class="fa fa-trash"></i>
                                    </button> -->

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js')}}" defer></script>
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                language: {
                    decimal:        "",
                    emptyTable:     "Tabla sin datos.",
                    info:           "Mostrando  _END_ de _TOTAL_ filas",
                    infoEmpty:      "Mostrando 0 de 0 de 0 filas",
                    infoFiltered:   "(Filtrado por _MAX_ total filas)",
                    infoPostFix:    "",
                    thousands:      ",",
                    lengthMenu:     "Mostrando _MENU_ filas",
                    loadingRecords: "Cargando...",
                    processing:     "Procesando...",
                    search:         "Buscar:",
                    zeroRecords:    "No se encontró nada relacionado con la búsqueda",
                    paginate: {
                        first:      "Primera",
                        last:       "Ultima",
                        next:       "Siguiente",
                        previous:   "Anterior"
                    }
                }
            });
        });

    </script>

    <script>
        function(){
            var region = $(this).val();
            $.get({{config('url')}}'/admin/modeloPorEquipo/'+equipo, function(data){
                var region = data[i] = nombre_region;
            });
        });
    </script>
@endpush
