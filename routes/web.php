<?php

//user routes
// de namespace rogt ervoor dat je niet elke keer User/ voor je controller moet zetten
// de resource heeft ingebouwde routes, thanks laravel :)
Route::group(['namespace' => 'User'], function(){
		// dit is de homepage
	    // forwardslashes zijn optioneel bij het begin van uw route
	    // Route::get('/', 'controller@functie'); = Route::get('', 'controller@functie');
		Route::get('', 'HomeController@index');
		Route::get('/teams/personal/{id}', 'WedstrijdController@personal');
		Route::resource('teams', 'TeamController');
		Route::get('stats', 'StatController@index');
		Route::resource('wedstrijden', 'WedstrijdController');
		Route::get('login', 'HomeController@login');
		Route::put('profile/update/{id}', 'HomeController@update')->name('profile.update');
		Route::get('profile/edit/{id}', 'HomeController@edit')->name('profile.edit');
		Route::get('profile', 'HomeController@profile')->name('profile');
});

Route::group(['namespace' => 'User', 'middleware' => 'auth:web'], function(){
		Route::get('/home', 'HomeController@profile');
});


//admin routes
// je kan je routes ook een naam megeven dan kan je later  via {{ route('naamroute') }} gebruiken de resource routes hebben dit standaard meegekregen
Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function(){
		Route::resource('admin/teams', 'TeamController');
		Route::post('admin/opmerkingen/create/', 'OpmerkingenController@store')->name('opmerkingen.store');
		Route::get('admin/wedstrijden/opmerkingen/{id}', 'WedstrijdController@opmerkingen');
		Route::resource('admin/wedstrijden', 'WedstrijdController');
		Route::resource('admin/stats', 'StatController');
		Route::resource('admin/user', 'UserController');
		Route::resource('admin/spelers', 'SpelerController');
		Route::get('admin/home', 'HomeController@index')->name('admin.home');
		Route::resource('admin/opmerkingen', 'OpmerkingenController');
		Route::resource('admin/admin', 'AdminController');
		//admin auth routes
		Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
});
//deze moeten buiten de group namespace staan omdat die ook de auth:admin middleware gebruikt en anders zou je nooit kunnen inloggen op de admin pagina je zou er enkel naartoe kunnen gaan als je al ingelogd bent als admin
Route::get('admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Admin\Auth\LoginController@login');
// deze route staat appart zodat ik deze pagina rap kan verwijderen indien nodig :P
Route::get('/index', function(){
	return view('user/index');
});
// de auth routes
Auth::routes();