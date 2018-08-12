@component('mail::message')
# {{ __("Solicitud aprobada!") }}

{{ __("El supervisor **:supervisor**, aprobó su solicitud.", ['supervisor'=>$supervisor]) }}
{{--  <img class="img-responsive" src="{{ url('storage/sisovi/camaras.jpg') }}" alt="Sisovi">  --}}

@component('mail::button', ['url' => url('/seguimiento-solicitudes/'), 'color' => 'blue'])
    {{ __("Ir al sitio") }}
@endcomponent

{{ __("Gracias") }}.

@endcomponent