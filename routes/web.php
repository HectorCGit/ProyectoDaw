<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/phpmyadmin', function () {
    return redirect('/vendor/phpmyadmin/phpmyadmin/index.php');
});

Route::get('/','App\Http\Controllers\WelcomeController@mostrarUbicaciones')->name('mostrar');


Route::post('/getVuelosIda','App\Http\Controllers\WelcomeController@getVuelosIda')->name('getVuelosIda');
Route::post('/getVuelosVuelta','App\Http\Controllers\WelcomeController@getVuelosVuelta')->name('getVuelosVuelta');


Route::post('/comprar','App\Http\Controllers\ShoppingController@comprarBilletes')->name('comprar');

Route::get('register/passenger','App\Http\Controllers\Auth\RegisterController@showPassengerRegistrationForm')->name('register.passenger');
Route::post('register/passenger','App\Http\Controllers\Auth\RegisterController@registerPassenger')->name('register.passenger.submit');

Route::get('register/company','App\Http\Controllers\Auth\RegisterController@showCompanyRegistrationForm')->name('register.company');
Route::post('register/company','App\Http\Controllers\Auth\RegisterController@registerCompany')->name('register.company.submit');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


