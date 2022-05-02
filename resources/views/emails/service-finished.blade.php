@component('mail::message')
# Terima kasih telah menggunakan jasa kami.

Dear {{$service->pendaftaran_service->pelanggan->nama}},

Kami mengucapkan terima kasih karena telah memilih kami untuk kebutuhan perbaikan AC mobil Anda.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
