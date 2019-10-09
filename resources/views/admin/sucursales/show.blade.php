@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Ver cliente</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.usuarios.index')}}">Usuarios</a></li>
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
                <h4 class="card-title m-t-10">Clinica Davila</h4>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <small class="text-muted">Dirección </small>
                <h6>Avenida recoleta 6666</h6>
            </div>
            <div class="card-body">
                <small class="text-muted">Descripcion </small>
                <h6>
                    Lorea El Ipsum Tení puro frío ranazo readi te tirita la pera oe si de corte querí ser leyenda washas te tiraste, detonao chantar odio gila soplamoco gila pasa paca coshino ql, brocacochi calmao asikalao washas te tirita la pera washas paquepo. Jato de corte soplamoco la legal hechiza zarpao truco caracho ascurrio, de finales asikalao puro gile conotao pasa paca coshino ql calzar washas zarpao truco, abrazo pa lo amigo balazo pa lo enemigo puro gile quieee andai con la pera machucao jato caracho.
                </h6>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <a href="#" class="button btn btn-primary btn-block">Editar</a>
            </div>
        </div>
    </div>
    <!-- Column -->

<div class="col-lg-6 col-xlg-9 col-md-7">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title m-t-10">Sucursales Clinica Davila</h4>
                    </div>
                    <div>
                        <a href="" class="btn btn-primary"> <i class="fa fa-plus"></i> Nueva sucursal</a>
                    </div>
                </div>
                <div class="table-responsive m-t-40">
                    <table id="usersTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre Sucursal</th>
                                <th>Direccion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sucursal 1</td>
                                <td>Avenida Recoleta 5567</td>
                                <td>
                                    <a class="btn btn-default btn-xs" href="{{ route('admin.clientes.index')}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-primary btn-xs" href="{{ route('admin.clientes.index')}}">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
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
@endpush