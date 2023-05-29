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
    return redirect('vendor\phpmyadmin\phpmyadmin\index.php');
});
//HOME
Route::group(['middleware' => ['role:company']], function () {
    Route::get('/','App\Http\Controllers\HomeCompanyController@mostrarhomeCompany')->name('homeCompany');

});
Route::get('/','App\Http\Controllers\HomePassengerController@listarVuelosAleatorios')->name('inicio');


Route::post('/getVuelosIda','App\Http\Controllers\HomePassengerController@getVuelosIda')->name('getVuelosIda');
Route::post('/getVuelosVuelta','App\Http\Controllers\HomePassengerController@getVuelosVuelta')->name('getVuelosVuelta');

//COMPRA
Route::post('/getBilletesIda','App\Http\Controllers\ShoppingController@insertarBilleteIda')->name('getBilletesIda');
Route::post('/getBilletesVuelta','App\Http\Controllers\ShoppingController@insertarBilleteVuelta')->name('getBilletesVuelta');
Route::post('/getBilletesDatos','App\Http\Controllers\ShoppingController@insertarDatosBillete')->name('getBilletesDatos');
Route::post('/nombresBilletes','App\Http\Controllers\ShoppingController@rellenarNombreBilletes')->name('nombresBilletes');
Route::post('/pagoFinal','App\Http\Controllers\ShoppingController@pagarFinal')->name('pagoFinal');
//CARRITO
Route::get('/carrito','App\Http\Controllers\ShoppingCartController@mostrarCarrito')->name('carrito');

Route::post('/cancelarBillete','App\Http\Controllers\ShoppingCartController@cancelarBillete')->name('cancelarBillete');
//RULETA
Route::get('/ruleta','App\Http\Controllers\RuletaController@mostrarRuleta')->name('ruleta');
//AUTENTIFICACIÓN
Route::get('register/passenger','App\Http\Controllers\Auth\RegisterController@showPassengerRegistrationForm')->name('register.passenger');
Route::post('register/passenger','App\Http\Controllers\Auth\RegisterController@registerPassenger')->name('register.passenger.submit');

Route::get('register/company','App\Http\Controllers\Auth\RegisterController@showCompanyRegistrationForm')->name('register.company');
Route::post('register/company','App\Http\Controllers\Auth\RegisterController@registerCompany')->name('register.company.submit');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeCompanyController::class, 'index'])->name('home');


