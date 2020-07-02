@extends('layouts.app')
@push('head-page')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Ver equipo</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.equipos.index')}}">Equipos</a></li>
            <li class="breadcrumb-item active"> Ver equipo</li>
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
                <h3>{{ $equipo->modelo->marca->nombre_marca}}</h3>
                <h4 class="card-title m-t-10">{{$equipo->modelo->nombre_modelo}}</h4>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <small class="text-muted">Asignado a: </small>
                <h6>{{$equipo->cliente->nombre_cliente}}</h6>
            </div>
            <div class="card-body">
                <small class="text-muted">Número de serie </small>
                <h6>
                    {{$equipo->num_serie_equipo}}
                </h6>
            </div>
            <div>
                <hr>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.equipos.edit', $equipo)}}" class="button btn btn-primary btn-block">Editar</a>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <div class="card-body">
				<h4 class="card-title m-t-10">Mantenimientos programados</h4>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Eliminar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="event-description"></div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
    </div>
</div>


@endsection

@push('styles')
<!-- Calendar CSS -->
<link href="{{ asset('js/plugins/calendar/dist/fullcalendar.css')}}" rel="stylesheet" />
@endpush

@push('scripts')
<script src="{{ asset('js/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('js/plugins/moment/moment.js')}}"></script>
<script src="{{ asset('js/plugins/calendar/dist/fullcalendar.min.js')}}" defer></script>
<script src="{{ asset('js/plugins/calendar/dist/locale/es.js')}}"></script>
<script src="{{ asset('js/plugins/calendar/dist/lang/es.js')}}"></script>

<script>
    	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			locale: 'es',
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '{{$fecha_primer_mantenimiento}}',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [

				@foreach ($mantenimientos as $mantenimiento)
				{
					title: 'Mantenimiento Programado',
					start: '{{$mantenimiento->fecha_mantenimiento}}',
					fecha: '{{$mantenimiento->fecha_mantenimiento}}',
					tecnico: '{{$mantenimiento->tecnico->nombre_tecnico}} {{$mantenimiento->tecnico->apellido_tecnico}}'

				},				
				@endforeach
			],
			eventClick: function(calEvent, jsEvent, view) {
				console.log(calEvent);
				$('#eventModalLabel').text(calEvent.title);
				$('#event-description').html('<p><strong>Fecha</strong>: '+ calEvent.fecha+ '</p>');
				$('#event-description').append('<p><strong>Técnico</strong>: '+calEvent.tecnico+ '</p>');
				$('#eventModal').modal();
			}
		});
		
	});
</script>
@endpush

