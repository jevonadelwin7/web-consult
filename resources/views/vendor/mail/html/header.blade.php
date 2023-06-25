@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://sisteminformasi.inspektoratmentawai.my.id/adminfrontend/assets/img/pemda.png" class="logo" >
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
