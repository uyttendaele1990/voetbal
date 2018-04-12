@component('mail::message')
Hey {{$match['user']}}, <br>
Jouw team heeft een wedstrijd gespeeld,<br>
{{$match['team1']}} {{$match['team1_score']}} - {{$match['team2_score']}} {{$match['team2']}} was de uitslag.<br>
Voor meer details over de wedstrijd kan je altijd bij ons terecht!<br>


@component('mail::button', ['url' => 'https://voetbal.be/wedstrijden'])
wedstrijden
@endcomponent

Nog een prettige dag gewenst,<br>
{{ config('app.name') }}
@endcomponent
