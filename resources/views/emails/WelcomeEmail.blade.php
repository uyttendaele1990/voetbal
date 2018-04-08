@component('mail::message')
Hey {{$data['name']}} <br>
Welkom bij VoetbalTracker.be, 

Onderstaande gegevens goed bijhouden, dit zijn je login-gegevens.

Email: {{$data['email']}} <br>
Wachtwoord: {{$data['password']}}


@component('mail::button', ['url' => 'voetbal.be'])
Browse verder
@endcomponent

Bedankt,<br>
{{ config('app.name') }}
@endcomponent
