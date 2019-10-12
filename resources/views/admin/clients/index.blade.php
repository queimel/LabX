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
                                <th>Nombre Cliente</th>
                                <th>Rut</th>
                                <th>Direccion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{$cliente->nombre_cliente}}</td>
                                <td>
                                    {{$cliente->rut_cliente}}
                                </td>
                                <td>
                                    {{$cliente->direccion_cliente}}
                                </td>
                                <td>
                                    <a class="btn btn-default btn-xs" href="{{ route('admin.clientes.show', $cliente)}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-primary btn-xs" href="{{ route('admin.clientes.edit', $cliente)}}">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" onclick="deleteData({{$cliente->id}})">
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>¿Estas Seguro de querer eliminar este cliente?</h5>
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

    </script>
      <script type="text/javascript">
        function deleteData(id)
        {
            var id = id;
            var url = '{{ route("admin.clientes.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
     </script>
@endpush
