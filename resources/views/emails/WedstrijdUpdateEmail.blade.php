@component('mail::message')
Hey {{$match['user']}}, <br>
Onze vorige email over de wedstrijd tussen {{$match['team1']}} en {{$match['team2']}} bevatte foutieve informatie,<br>
{{$match['team1']}} {{$match['team1_score']}} - {{$match['team2_score']}} {{$match['team2']}} was de uitslag.<br>
Voor meer details over de wedstrijd kan je altijd bij ons terecht!<br>


@component('mail::button', ['url' => 'https://voetbal.be/wedstrijden'])
wedstrijden
@endcomponent

Onze exscuses voor het ongemak,<br>
en nog een prettige dag gewenst,<br>
{{ config('app.name') }}
@endcomponent
