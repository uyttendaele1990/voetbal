<?php
							
								//Guest routes

// De namespace zogt ervoor dat je niet elke keer User/ voor je controller moet zetten
Route::group(['namespace' => 'User'], function(){
		// De homepage
		Route::get('', 'HomeController@index')->name('home');
		// De statistieken pagina
		Route::get('stats', 'StatController@index');
		// De wedstrijden pagina met alle wedstrijden opgelijst
		Route::get('wedstrijden', 'WedstrijdController@index');
		// De pagina met de details over de wedtrijd
		Route::get('wedstrijden/{id}', 'WedstrijdController@show');	
		// Terms of agreement
		Route::get('terms', 'HomeController@terms');
});
							
								//User routes

// Gebruik gemaakt van de standaard middleware zodat deze paginas enkel zichtbaar zijn voor mensen die ingelogd zijn als user 
Route::group(['namespace' => 'User', 'middleware' => 'auth:web'], function(){
		// Emailadress in de lijst zetten voor het volgen van een team
		Route::get('email/{id}', 'MailController@show');
		// Emailadress uit de lijst halen
		Route::delete('email/{id}', 'MailController@destroy')->name('email.destroy');
		// Pagina met alle wedstrijden van 1 team
		Route::get('teams/personal/{id}', 'TeamController@personal');
		// Pagina met alle Teams uit de competitie
		Route::get('teams', 'TeamController@index');
		// Teampagina van gekozen team
		Route::get('teams/{id}', 'TeamController@show');
		// Profiel update
		Route::put('profile/update/{id}', 'HomeController@update')->name('profile.update');
		// Profiel edit pagina
		Route::get('profile/edit/{id}', 'HomeController@edit')->name('profile.edit');
});

								//Admin routes

// Middleware custom gemaakt voor de admins
Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function(){
		// Homepagina voor de admins
		Route::get('admin/home', 'HomeController@index')->name('admin.home');
		// Alle routes mbt de teams
		Route::resource('admin/teams', 'TeamController');
		// Opmerkingen opslaan
		Route::post('admin/opmerkingen/create/', 'OpmerkingenController@store')->name('opmerkingen.store');
		// Opmerkingen pagina
		Route::get('admin/wedstrijden/opmerkingen/{id}', 'WedstrijdController@opmerkingen');
		// Alle routes mbt de wedstrijden
		Route::resource('admin/wedstrijden', 'WedstrijdController');
		// De statistieken pagina, mss overbodig voor de adminside?
		Route::get('admin/stats', 'StatController@index')->name('stats.index');
		// Overzicht van alle users
		Route::get('admin/user', 'UserController@index')->name('user.index');
		// Edit pagina van de user
		Route::get('admin/user/{id}/edit', 'UserController@edit')->name('user.edit');
		// Userdetails updaten
		Route::put('admin/user/update/{id}', 'UserController@update')->name('user.update');
		// User deleten
		Route::delete('admin/user/{id}', 'UserController@destroy')->name('user.destroy');
		// Alle routes mbt de spelers
		Route::resource('admin/spelers', 'SpelerController');
		// Opmerkingen maken
		Route::get('admin/opmerkingen/create', 'OpmerkingenController@create')->name('opmerkingen.create');
		// Opmerkingen opslaan
		Route::post('admin/opmerkingen', 'OpmerkingenController@store')->name('opmerkingen.store');
		// Opmerkingen deleten
		Route::delete('admin/opmerkingen/{id}', 'OpmerkingenController@destroy')->name('opmerkingen.destroy');
		// Alle routes mbt de admins
		Route::resource('admin/admin', 'AdminController');
		// admin logout
		Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
});
// Deze moeten buiten de group namespace staan omdat die ook de auth:admin middleware gebruikt
// Admin login
Route::get('admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Admin\Auth\LoginController@login');

// De auth routes voor de user side (login registrer, ...)
Auth::routes();
// google login/register routes 
Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/index', function(){
	return view('user/index');
});