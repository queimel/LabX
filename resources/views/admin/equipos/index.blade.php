@extends('layouts.app')

@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Listado de Equipos</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Equipos</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <div>
                        <a class="btn btn-primary" href="{{route('admin.equipos.create')}}"> <i class="fa fa-plus"></i> Nuevo Equipo</a>
                    </div>
                </div>
                <div class="table-responsive m-t-40">
                    <table id="usersTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Número de serie</th>
                                <th>Cliente</th>
                                <th>Sucursal</th>
                                <th>Fecha mantención</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipos as $equipo)
                            <tr>
                                <td>
                                    {{ $equipo->modelo->marca->nombre_marca}}
                                </td>
                                <td>
                                    {{ $equipo->modelo->nombre_modelo}}
                                </td>
                                <td>
                                    {{$equipo->num_serie_equipo}}
                                </td>
                                <td>
                                    @if ($equipo->cliente->parent)
                                    {{ $equipo->cliente->parent->nombre_cliente}}
                                    @else
                                    {{$equipo->cliente->nombre_cliente}}
                                    @endif
                                </td>
                                <td>
                                    {{$equipo->cliente->nombre_cliente}}
                                </td>
                                <td>
                                    {{$equipo->fecha_ultima_mantencion_equipo}}
                                </td>
                                <td>
                                    <a class="btn btn-info btn-xs" href="{{ route('admin.equipos.show', $equipo)}}" data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-primary btn-xs" href="{{ route('admin.equipos.edit', $equipo)}}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{$equipo->id}})">
                                        <i class="fa fa-trash"></i>
                                    </button>
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

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Eliminar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>¿Estas Seguro de querer eliminar este equipo?</h5>
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

        function deleteData(id)
        {
            var id = id;
            var url = '{{ route("admin.equipos.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }

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
