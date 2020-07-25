@component('mail::message')
# Appointment
Hi {{ $request->instructor->fname }} !!
<br>
{{ $x }}.
<br>

@component('mail::button', ['url' => url('appointment/'. $request['id'])])
View Appointment
@endcomponent



Thanks,<br>
{{ config('app.name') }}
@endcomponent
