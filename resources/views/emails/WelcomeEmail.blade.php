@component('mail::message')
Welkom bij VoetbalTracker.be {{$data['name']}}

Onderstaande gegevens goed bijhouden, dit zijn je login-gegevens.

Email: {{$data['email']}} <br>
Wachtwoord: {{$data['password']}}


@component('mail::button', ['url' => 'voetbal.be'])
Browse verder
@endcomponent

Bedankt,<br>
{{ config('app.name') }}
@endcomponent
