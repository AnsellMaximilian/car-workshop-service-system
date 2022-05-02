@component('mail::message')
# Permintaan sudah diterima

Permintaan pendaftaran Anda sudah diterima.

No. Plat: {{$pendaftaran->no_plat}}
<br>
Waktu: {{$pendaftaran->waktu_booking}}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
