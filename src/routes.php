<?php 


/*SOCIALITE AUTHENTICATION ROUTE SECTION*/
Route::group(['prefix'=>'admin','middleware' => ['web']], function () {

	Route::get('home', 'MspPack\DDSAdmin\Http\HomeController@index')->name('home');

	Route::get('login', 'MspPack\DDSAdmin\Http\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'MspPack\DDSAdmin\Http\Auth\LoginController@login');
    Route::get('logout', 'MspPack\DDSAdmin\Http\Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'MspPack\DDSAdmin\Http\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'MspPack\DDSAdmin\Http\Auth\RegisterController@register');
    Route::get('register/verify/{token}', 'MspPack\DDSAdmin\Http\Auth\RegisterController@verify');

    // Password Reset Routes...
    Route::get('password/reset', 'MspPack\DDSAdmin\Http\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'MspPack\DDSAdmin\Http\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'MspPack\DDSAdmin\Http\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'MspPack\DDSAdmin\Http\Auth\ResetPasswordController@reset');

	Route::get('auth/{provider}', 'MspPack\DDSAdmin\Http\Auth\LoginController@redirectToProvider');
	Route::get('auth/{provider}/callback', 'MspPack\DDSAdmin\Http\Auth\LoginController@handleProviderCallback');


	/*PINTEREST AUTHENTICATION ROUTE SECTION*/
	Route::get('custom-auth/{provider}', 'MspPack\DDSAdmin\Http\Auth\LoginController@redirectToCustomProvider');
	Route::get('custom-auth/{provider}/callback', 'MspPack\DDSAdmin\Http\Auth\LoginController@handleCustomProviderCallback');
});

/*USER MANAGEMENT*/
Route::group(['prefix'=>'admin','middleware' => ['web','role:admin|user']], function()
{
	/*PROFILE*/
	Route::get('user/profile','MspPack\DDSAdmin\Http\UserController@profile');
	Route::post('user/profile','MspPack\DDSAdmin\Http\UserController@postProfile');

	Route::resource('user','MspPack\DDSAdmin\Http\UserController');
	Route::resource('role','MspPack\DDSAdmin\Http\RoleController');
	Route::resource('permission','MspPack\DDSAdmin\Http\PermissionController');
	Route::get('role/{id}/permission', 'MspPack\DDSAdmin\Http\RoleController@permissions');
	Route::post('role/{id}/permission', 'MspPack\DDSAdmin\Http\RoleController@permissionsStore');

});

/*ADMIN ROUTE*/
Route::group(['prefix'=>'admin','middleware' => ['web','role:admin']], function(){
	Route::resource('setting','MspPack\DDSAdmin\Http\SettingController');
});