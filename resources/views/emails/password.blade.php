@component('mail::message')
# Reset Password

Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

Jika Anda tidak meminta reset password, tidak ada tindakan lebih lanjut yang diperlukan.

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
