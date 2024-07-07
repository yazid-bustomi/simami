@component('mail::message')
# Verifikasi Alamat Email Anda

Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda.

@component('mail::button', ['url' => $url])
Verifikasi Email
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
