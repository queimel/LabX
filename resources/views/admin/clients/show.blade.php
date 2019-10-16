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
                <h6>{{$cliente->direccion_cliente}}, {{$cliente->comuna->nombre_comuna}}</h6>
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
                    <button data-toggle="modal" data-target="#createModal" class="btn btn-primary"> <i class="fa fa-plus"></i> Nueva sucursal</button>
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
                            @foreach ($cliente->children as $sucursal)
                            <tr>
                                <td>{{$sucursal->id_sucursal}}</td>
                                <td>{{$sucursal->nombre_cliente}}</td>
                                <td>{{$sucursal->direccion_cliente}}, {{ $sucursal->comuna->nombre_comuna}}</td>
                                <td>

                                    <a class="btn btn-info btn-xs" href="{{ route('admin.sucursales.show', $sucursal)}}" data-toggle="tooltip" data-placement="top" title="Ver detalle">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-primary btn-xs" href="{{ route('admin.sucursales.edit', $sucursal)}}">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{$sucursal->id}})">
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="form p-t-20" method="POST" action="{{ route('admin.sucursales.store')}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear nueva sucursal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="parent_id" name="parent_id" value="{{$cliente->id}}">
                    <div class="form-group  @error('nombre_cliente') has-danger @enderror">
                        <label>Nombre de Sucursal</label>
                        <input type="text"
                            class="form-control  @error('nombre_cliente') form-control-danger @enderror"
                            id="nombre_cliente" name="nombre_cliente"
                            value="{{ old('nombre_cliente')}}">
                        @error('nombre_cliente')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <input type="hidden" id="rut_cliente" name="rut_cliente"
                        value="{{$cliente->rut_cliente}}">

                    <div class="form-group  @error('descripcion_cliente') has-danger @enderror">
                        <label>Descripcion</label>
                        <textarea
                            class="form-control  @error('descripcion_cliente') form-control-danger @enderror"
                            id="descripcion_cliente" name="descripcion_cliente">
                                        {{ old('descripcion_cliente')}}
                                </textarea>
                        @error('descripcion')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group  @error('direccion_cliente') has-danger @enderror">
                        <label>Dirección</label>
                        <input type="text"
                            class="form-control  @error('direccion_cliente') form-control-danger @enderror"
                            id="direccion_cliente" name="direccion_cliente"
                            value="{{ old('direccion_cliente')}}">
                        @error('direccion_cliente')
                        <small class="form-control-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group  @error('id_comuna') has-danger @enderror">
                        <label for="">Region</label>
                        <select class="custom-select @error('id_comuna') form-control-danger @enderror" id="region" name="region_cliente" required>
                            <option selected>Region</option>
                            @foreach ($regiones as $region)
                            <option value="{{$region->id}}">{{$region->nombre_region}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group @error('id_comuna') has-danger @enderror">
                        <label for="">Provincia</label>
                        <select class="custom-select @error('id_comuna') form-control-danger @enderror" id="provincia" name="provincia_cliente" disabled
                            required>

                        </select>
                    </div>
                    <div class="form-group @error('id_comuna') has-danger @enderror">
                        <label for="">Comuna</label>
                        <select class="custom-select @error('id_comuna') form-control-danger @enderror" id="comuna" name="id_comuna" disabled required>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                        class="btn btn-success waves-effect waves-light m-r-10">Crear
                        Sucursal</button>
                    <a class="btn btn-inverse waves-effect waves-light"
                        href="{{ URL::previous() }}">Cancelar</a>
                </div>
            </div>
        </form>
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
            var url = "/admin/sucursales/"+id;
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>


    @if (count($errors) > 0)
    <script>
        $( document ).ready(function() {
            $('#createModal').modal('show');
        });
    </script>
    @endif

<script>
        $(document).ready(function(){
            $("#region").change(function(){
                var region = $(this).val();
                $.get({{config('url')}}'/admin/provinciasPorRegion/'+region, function(data){
                    var provincias_select = '<option value="">Seleccione Provincia</option>'
                        for (var i=0; i<data.length;i++)
                        provincias_select+='<option value="'+data[i].id+'">'+data[i].nombre_provincia+'</option>';

                        $("#provincia").html(provincias_select).removeAttr('disabled');
                });
            });

            $("#provincia").change(function(){
                var provincia = $(this).val();
                $.get({{config('url')}}'/admin/comunasPorProvincia/'+provincia, function(data){
                    var comunas_select = '<option value="">Seleccione Comuna</option>'
                        for (var i=0; i<data.length;i++)
                        comunas_select+='<option value="'+data[i].id+'">'+data[i].nombre_comuna+'</option>';

                        $("#comuna").html(comunas_select).removeAttr('disabled');
                });
            });
        });
    </script>
@endpush
