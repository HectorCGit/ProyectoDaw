<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeCompanyController;
use App\Http\Controllers\HomePassengerController;


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
Route::middleware(['auth', 'role:company'])->group(function () {
    //Route::get('/homeCompany', [HomeCompanyController::class, 'mostrarHomeCompany'])->name('homeCompany');
    Route::get('/homeCompany', 'App\Http\Controllers\HomeCompanyController@mostrarHomeCompany')->name('homeCompany');
    //HOME COMPANY
    Route::get('/crearVuelo', 'App\Http\Controllers\HomeCompanyController@crearVuelo')->name('crearVuelo');
    Route::post('/guardarVuelo', 'App\Http\Controllers\HomeCompanyController@guardarVuelo')->name('guardarVuelo');
    Route::post('/eliminarVuelo', 'App\Http\Controllers\HomeCompanyController@eliminarVuelo')->name('eliminarVuelo');
    Route::post('/verBilletes', 'App\Http\Controllers\HomeCompanyController@verBilletes')->name('verBilletes');
    Route::post('/eliminarBillete', 'App\Http\Controllers\HomeCompanyController@eliminarBillete')->name('eliminarBillete');

});


Route::middleware(['auth', 'role:passenger'])->group(function () {
    Route::get('/homePassenger', 'App\Http\Controllers\HomePassengerController@listarVuelosAleatorios')->name('homePassenger');
    Route::post('/getVuelosVuelta', 'App\Http\Controllers\HomePassengerController@getVuelosVuelta')->name('getVuelosVuelta');

//COMPRA
    Route::post('/getBilletesIda', 'App\Http\Controllers\ShoppingController@insertarBilleteIda')->name('getBilletesIda');
    Route::post('/getBilletesVuelta', 'App\Http\Controllers\ShoppingController@insertarBilleteVuelta')->name('getBilletesVuelta');
    Route::post('/getBilletesDatos', 'App\Http\Controllers\ShoppingController@insertarDatosBillete')->name('getBilletesDatos');
    Route::post('/nombresBilletes', 'App\Http\Controllers\ShoppingController@rellenarNombreBilletes')->name('nombresBilletes');
    Route::post('/pagoFinal', 'App\Http\Controllers\ShoppingController@pagarFinal')->name('pagoFinal');
//CARRITO
    Route::get('/billetesPassenger', 'App\Http\Controllers\ShoppingCartController@mostrarBilletesPassenger')->name('billetesPassenger');

    Route::post('/cancelarBillete', 'App\Http\Controllers\ShoppingCartController@cancelarBillete')->name('cancelarBillete');
//CHECK IN
    Route::get('/billetesCheckIn', 'App\Http\Controllers\CheckInController@mostrarBilletesCheckIn')->name('billetesCheckIn');
    Route::post('/checkIn', 'App\Http\Controllers\CheckInController@checkIn')->name('checkIn');
    Route::get('/billetesCheckIn', 'App\Http\Controllers\CheckInController@mostrarBilletesCheckIn')->name('billetesCheckIn');


//RULETA
    Route::get('/ruleta', 'App\Http\Controllers\RuletaController@mostrarRuleta')->name('ruleta');
    Route::post('/premio', 'App\Http\Controllers\RuletaController@generarPremio')->name('premio');
    Route::get('/contacto', 'App\Http\Controllers\ContactController@mostrarcontacto')->name('contacto');
});
Route::get('/', 'App\Http\Controllers\HomePassengerController@listarVuelosAleatorios')->name('homePassenger');
Route::post('/getVuelosIda', 'App\Http\Controllers\HomePassengerController@getVuelosIda')->name('getVuelosIda');
//FORO
Route::get('/foro', 'App\Http\Controllers\ForoController@mostrarTemas')->name('foro');
Route::post('/crearTemas', 'App\Http\Controllers\ForoController@crearTemas')->name('crearTemas');
Route::post('/crearMensajes', 'App\Http\Controllers\ForoController@crearMensajes')->name('crearMensajes');
Route::post('/mostrarMensajes', 'App\Http\Controllers\ForoController@mostrarMensajes')->name('mostrarMensajes');


//AUTENTIFICACIÓN
Route::get('register/passenger', 'App\Http\Controllers\Auth\RegisterController@showPassengerRegistrationForm')->name('register.passenger');
Route::post('register/passenger', 'App\Http\Controllers\Auth\RegisterController@registerPassenger')->name('register.passenger.submit');

Route::get('register/company', 'App\Http\Controllers\Auth\RegisterController@showCompanyRegistrationForm')->name('register.company');
Route::post('register/company', 'App\Http\Controllers\Auth\RegisterController@registerCompany')->name('register.company.submit');
Auth::routes();
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    if(Auth::user()->hasAnyRole('company')){
        return $this->redirectTo = route('homeCompany') ;

    }else{
        return $this->redirectTo = route('homePassenger') ;
    }
})->middleware(['auth', 'signed'])->name('verification.verify');



