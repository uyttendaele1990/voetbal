@extends('user/layouts/app')

@section('bg-img', asset('user/img/home-bg.jpg'))

@section('title', 'Voetbal tracker')

@section('subtitle', 'Nu nog gemakkelijker om jouw favoriete team te volgen')

@section('main-content')
<div class='container'> 
	<h2 style='text-align: center;'>
	@guest
 	  	Bezoek onze site als:
 	</h2>
 	<br>
 	
 	<div style='text-align: center;''>
		<span>	      
		   <a class="btn btn-primary" href="/stats">
	            <span class="btn__text">
	                Gast
	            </span>
	       </a>
	       <a class="btn btn-success" href="/login">
	            <span class="btn__text">
	                User
	            </span>
	       </a>

	       <a class="btn btn-danger" href="admin/login">
	            <span class="btn__text">
	                Admin
	            </span>
	       </a>
		</span>
	</div>
	@else
	 Welkom {{ Auth::user()->name }}
	@endguest
</div>    
@endsection