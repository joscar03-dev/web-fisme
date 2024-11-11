@props(['url'])
<tr>
<td class="header">
<a href="https://congresofisme.untrm.edu.pe/" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
    <h1><br>Facultad de Ingeniería de Sistemas y Mecánica Eléctrica</br></h1>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
