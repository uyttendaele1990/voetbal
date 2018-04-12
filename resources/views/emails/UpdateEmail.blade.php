@component('mail::message')
Hey {{$data['name']}} <br>
U hebt uw gegevens aangepast, 

Onderstaande gegevens goed bijhouden, dit zijn je login-gegevens.

Email: {{$data['email']}} <br>
Wachtwoord: {{$data['password']}}


@component('mail::button', ['url' => 'https://voetbal.be'])
Browse verder
@endcomponent

Nog een prettige dag verder,<br>
{{ config('app.name') }}
@endcomponent
