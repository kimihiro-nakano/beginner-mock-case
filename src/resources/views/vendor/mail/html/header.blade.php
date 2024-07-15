<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Atte')
<h1>Atte</h1>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
