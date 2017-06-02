<?php 
	//Route::get('login', 'MspPack\LaravelApp\Http\Auth\LoginController@login');

/*Route::get('login', function () {
	return view('auth.login');
});*/


//Route::get('login', '\App\Http\Controllers\Auth\LoginController@login');
//Route::get('logout', 'MspPack\LaravelApp\Http\Auth\LoginController@logout');
Route::get('register/verify/{token}', 'MspPack\LaravelApp\Http\Auth\@verify'); 

//Route::get('/home', 'MspPack\LaravelApp\Http\HomeController@index')->name('home');

/*SOCIALITE AUTHENTICATION ROUTE SECTION*/
Route::group(['middleware' => ['web']], function () {
Route::get('auth/{provider}', 'MspPack\LaravelApp\Http\Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'MspPack\LaravelApp\Http\Auth\LoginController@handleProviderCallback');


/*PINTEREST AUTHENTICATION ROUTE SECTION*/
Route::get('custom-auth/{provider}', 'MspPack\LaravelApp\Http\Auth\LoginController@redirectToCustomProvider');
Route::get('custom-auth/{provider}/callback', 'MspPack\LaravelApp\Http\Auth\LoginController@handleCustomProviderCallback');
});
/*USER MANAGEMENT*/
/*Route::group(['middleware' => ['role:admin|user']], function()
{
	Route::resource('user','MspPack\LaravelApp\Http\UserController');
	Route::resource('role','MspPack\LaravelApp\Http\RoleController');
	Route::resource('permission','MspPack\LaravelApp\Http\PermissionController');
	Route::get('role/{id}/permission', 'MspPack\LaravelApp\Http\RoleController@permissions');
	Route::post('role/{id}/permission', 'MspPack\LaravelApp\Http\RoleController@permissionsStore');
	
});*/