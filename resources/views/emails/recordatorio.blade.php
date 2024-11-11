@component('mail::message')
# {{ $data['titulo'] }}

Estimado(a) *{{ $registro->nombres }} {{ $registro->apellidos }}*,

{{ $data['mensaje'] }}

### Detalles del Evento:
@component('mail::table')
| Atributo     | Detalle |
|:-------------|:--------|
| *Fecha*    | {{ \Carbon\Carbon::parse($registro->evento->fecha_inicio)->format('d/m/Y') }} |
| *Lugar*    | {{ $registro->evento->lugar }} |
@endcomponent

@component('mail::panel')
Por favor, presente este código QR adjunto al ingresar al evento.
@endcomponent

Gracias por su participación.

@if(isset($data['contacto']))
### Contacto:
Si tiene alguna pregunta, no dude en contactarnos.
@endif

Gracias,<br>
@endcomponent
