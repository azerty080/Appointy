<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/sparkpost', function () {
/*
    Mail::send('email.test', [], function ($message) {
        $message
        ->from('appointy@niels.vannimmen.mtantwerp.eu', 'Appointy')
        ->to('niels.van.nimmen@gmail.com', 'Niels Van Nimmen')
        ->subject('hahaha, im the subject now');
    });
*/
    
// Mail::to('appointy@niels.vannimmen.mtantwerp.eu')->send(new TestMail());

});

    




Route::get('/', 'HomeController@index')->name('index');
Route::redirect('/home', '/');


Route::get('/afspraken', 'AppointmentController@appointments')->name('appointments');


Route::post('/removeappointment', 'AppointmentController@removeappointment')->name('removeappointment');


Route::get('/favorieten', 'BookmarkController@bookmarks')->name('bookmarks');


Route::post('/zaak/{name}{id}/addbookmark', 'BookmarkController@addbookmark')->name('addbookmark');
Route::post('/zaak/{name}{id}/removebookmark', 'BookmarkController@removebookmark')->name('removebookmark');


// Account
Route::get('/account', 'AccountController@account')->name('account');

Route::get('/account/informatie-bijwerken', 'AccountController@editaccount')->name('editaccount');
Route::post('/account/updateaccount', 'AccountController@updateaccount')->name('updateaccount');

Route::get('/account/openingsuren-bijwerken', 'AccountController@editopeninghours')->name('editopeninghours');
Route::post('/account/updateopeninghours', 'AccountController@updateopeninghours')->name('updateopeninghours');


Route::post('/account/deleteaccount', 'AccountController@deleteaccount')->name('deleteaccount');




Route::get('/searchresults', 'HomeController@searchresults')->name('searchresults');



Route::get('/zaak/{name}{id}', 'HomeController@businessdetail')->name('businessdetail');



// -------
Route::get('/zaak/{name}{id}/addbookmark', 'HomeController@addbookmark')->name('addbookmark');
// -------


Route::get('/zaak/{name}{id}/kalender/{addedweeks}', 'HomeController@businesscalendar')->name('businesscalendar');




//Route::get('/zaak/{name}{id}/{day}/{time}', 'AppointmentController@appointmentform')->name('appointmentform');
Route::post('/zaak/{name}{id}/afspraak-maken', 'AppointmentController@appointmentform')->name('appointmentform');
Route::get('/zaak/{name}{id}/afspraak-maken', 'AppointmentController@appointmentform')->name('appointmentform');





Route::post('/createappointment', 'AppointmentController@createappointment')->name('createappointment');





Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@loginsubmit')->name('loginsubmit');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');




Route::get('/register', 'Auth\RegisterController@register')->name('register');

Route::get('/register/klant', 'Auth\RegisterController@registerclient')->name('register-client');
Route::post('/register/klant', 'Auth\RegisterController@registerclientsubmit')->name('register-client-submit');

Route::get('/register/zaak', 'Auth\RegisterController@registerbusiness')->name('register-business');
Route::post('/register/zaak', 'Auth\RegisterController@registerbusinesssubmit')->name('register-business-submit');


Route::post('/register', 'Auth\RegisterController@registersubmit')->name('registersubmit');





Route::get('/autocompletename', 'HomeController@autocompletename')->name('autocompletename');
Route::get('/autocompleteprofession', 'HomeController@autocompleteprofession')->name('autocompleteprofession');
Route::get('/autocompletetownship', 'HomeController@autocompletetownship')->name('autocompletetownship');


//Auth::routes();