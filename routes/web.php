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






Route::get('/', 'HomeController@index')->name('index');
Route::redirect('/home', '/');





Route::get('/account', 'AccountController@account')->name('account');





//Route::post('/searchbusiness', 'HomeController@searchbusiness')->name('searchbusiness');

Route::get('/searchresults', 'HomeController@searchresults')->name('searchresults');



Route::get('/zaak/{name}-{id}', 'HomeController@businessdetail')->name('businessdetail');

Route::get('/zaak/{name}-{id}/kalender', 'HomeController@businesscalendar')->name('businesscalendar');




Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@loginsubmit')->name('loginsubmit');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');




Route::get('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/register', 'Auth\RegisterController@registersubmit')->name('registersubmit');



//Auth::routes();