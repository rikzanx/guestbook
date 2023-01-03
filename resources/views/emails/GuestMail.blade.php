@component('mail::message')
<h2>Hello {{$body['name']}},</h2>
<p>Data Pendaftaran:</p>
<p>Kode pendaftaran: {{$body['id']}}<br>
Nama: {{$body['name']}}<br>
Email: {{$body['email']}}<br>
Telp: {{$body['telp']}}<br>
Keterangan: {{$body['keterangan']}}<br>
Tanggal: {{$body['created_at']}}</p>

{{-- <p>Visit @component('mail::button', ['url' => $body['url_b']])
Laravel Tutorials
@endcomponent and learn more about the Laravel framework.</p> --}}
    
Thanks,<br>
{{ config('app.name') }}<br>
Keamanan Petrokimia.

@endcomponent
