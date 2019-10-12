@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Ver cliente</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.usuarios.index')}}">Cliente</a></li>
            <li class="breadcrumb-item active"> Ver cliente</li>
        </ol>
    </div>
</div>
@endpush
@section('content')
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title m-t-10">{{$cliente->nombre_cliente}}</h4>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <small class="text-muted">Dirección </small>
                <h6>{{$cliente->direccion_cliente}}</h6>
            </div>
            <div class="card-body">
                <small class="text-muted">Descripcion </small>
                <h6>
                        {{$cliente->descripcion}}
                </h6>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.clientes.edit', $cliente)}}" class="button btn btn-primary btn-block">Editar</a>
            </div>
        </div>
    </div>
    <!-- Column -->

<div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title m-t-10">Sucursales {{$cliente->nombre_cliente}}</h4>
                    </div>
                    <div>
                    <a href="{{route('admin.sucursales.create',  $cliente)}}" class="btn btn-primary"> <i class="fa fa-plus"></i> Nueva sucursal</a>
                    </div>
                </div>
                <div class="table-responsive m-t-40">
                    <table id="usersTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre Sucursal</th>
                                <th>Direccion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sucursales as $sucursal)
                            <tr>
                                <td>{{$sucursal->id_sucursal}}</td>
                                <td>{{$sucursal->nombre_cliente}}</td>
                                <td>{{$sucursal->direccion_cliente}}</td>
                                <td>
                                    <a class="btn btn-default btn-xs" href="{{ route('admin.sucursales.show', ['cliente'=>$cliente,'sucursal'=>$sucursal->id_sucursal])}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-primary btn-xs" href="{{ route('admin.sucursales.edit', ['cliente'=>$cliente,'sucursal'=>$sucursal->id_sucursal])}}">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" onclick="deleteData({{$cliente->id}}, {{$sucursal->id_sucursal}})">
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
<!-- Row -->
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>¿Estas Seguro de querer eliminar esta sucursal?</h5>
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
        function deleteData(id, id_sucursal)
        {
            var id = id;
            var url = "/admin/sucursales/"+id+"/"+id_sucursal;
            console.log(url);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>
@endpush
