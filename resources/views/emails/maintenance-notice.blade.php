@component('mail::message')
# {{ config('app.name')}}

Tienes un mantenimiento agendado.

@component('mail::table')
    | Marca | Modelo | Fecha |
    |:---------| :----------| :----------|
    | {{ $marca }} | {{ $modelo }} | {{ $dia_mantencion }} |
@endcomponent


Gracias,<br>
{{ config('app.name') }}
@endcomponent
