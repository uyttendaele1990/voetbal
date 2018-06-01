@extends('user/layouts/app2')
@section('headSection')
<style>
	/*Cookie Consent Begin*/
#cookieConsent {
    background-color: rgba(20,20,20,0.8);
    min-height: 26px;
    font-size: 14px;
    color: #ccc;
    line-height: 26px;
    padding: 8px 0 8px 30px;
    font-family: "Trebuchet MS",Helvetica,sans-serif;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    display: none;
    z-index: 9999;
}
#cookieConsent a {
    color: #4B8EE7;
    text-decoration: none;
}
#closeCookieConsent {
    float: right;
    display: inline-block;
    cursor: pointer;
    height: 20px;
    width: 20px;
    margin: -15px 0 0 0;
    font-weight: bold;
}
#closeCookieConsent:hover {
    color: #FFF;
}
#cookieConsent a.cookieConsentOK {
    background-color: #F1D600;
    color: #000;
    display: inline-block;
    border-radius: 5px;
    padding: 0 20px;
    cursor: pointer;
    float: right;
    margin: 0 60px 0 10px;
}
#cookieConsent a.cookieConsentOK:hover {
    background-color: #E0C91F;
}
/*Cookie Consent End*/

</style>
<script>
	$(document).ready(function(){   
    setTimeout(function () {
        $("#cookieConsent").fadeIn(200);
     }, 1000), {passive:true};
    $("#closeCookieConsent, .cookieConsentOK").click(function() {
        $("#cookieConsent").fadeOut(200);
    }); 
}); 

</script>
@endsection
@section('main-content')
<div class='container' style='text-align: center;'>
<br>
	@guest
	<h2 >
	<div id="cookieConsent">
    <div id="closeCookieConsent">x</div>
    Deze website maakt gebruik van cookies. <a target="_blank" href="/terms">Terms of agreement</a>. <a class="cookieConsentOK">Ik ga ermee akkoord</a></div>
    <div>Bezoek deze site als:</div> 	
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
	<div style='font-size: 150%;margin-bottom:25px;'>
	 Welkom {{ Auth::user()->name }}
	</div>
	 @if(Auth::user()->google)
	 <h2>
		 <a href='{{ route("profile.edit", Auth::user()->id)}}'>
		  <div style='background:red; border-radius:25px;padding:15px'> Gelieve uw wachtwoord aan te passen, u hebt een random wachtwoord gekregen</div>
		 </a>
	 </h2>
	  @endif
	  @if((App\Model\admin\admin::where('seizoen', 1)->first()))
	 	 <div class='well' style='text-align:center; margin-top:25px;background:lightgrey;border-radius:36px'>
	 	 	<h1 style='padding-top:15px'>Seizoen {{date('Y')-1}} - {{date('Y')}}</h1>
	 	 	<hr>
	 	 	<div>
	 	 		<h2>competitie winnaar:<h2><br><span style='font-size: 200%;'> <a href='teams/{{$winnaar[0]->id}}'>{{$winnaar[0]->naam}}  
	 	 		<img src="/storage/{{$winnaar[0]->logo}}" style='width:100px; height:100px;'></a></span>
			</div>
	 	 	<div>
	 	 	<br>
	 	 	<h2>Topscorers:<h2>
	 	 	<br>
	 	 	<ol>
	 	    @foreach($topscorers as $top)
	 	 		<li><img src="/storage/{{$top->foto}}" style='width:75px; height:75px;border-radius:50%'><text style='font-size: 175%;'>{{$top->naam}}</text> met <text style='font-size: 150%;'>{{$top->doelpunten_saldo}}</text> goalen  <small>{{$top->teams->slug}}</small></li>
	 	 		<br>
	 	 		<br>
	 	 	@endforeach
	 	 	</ol>
	 	 	</div>
	 	 </div>
	  @endif 
	@endguest
</div>    
@endsection