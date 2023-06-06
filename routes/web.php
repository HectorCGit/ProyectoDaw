<?php

use App\Http\Controllers\ForoController;
use App\Http\Controllers\UserCompanyController;
use App\Http\Controllers\UserPassengerController;
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
    //HOME COMPANY
    Route::get('/homeCompany', 'App\Http\Controllers\HomeCompanyController@mostrarHomeCompany')->name('homeCompany')->middleware('verified');;
    Route::get('/crearVuelo', 'App\Http\Controllers\HomeCompanyController@crearVuelo')->name('crearVuelo')->middleware('verified');;
    Route::post('/guardarVuelo', 'App\Http\Controllers\HomeCompanyController@guardarVuelo')->name('guardarVuelo')->middleware('verified');;
    Route::post('/eliminarVuelo', 'App\Http\Controllers\HomeCompanyController@eliminarVuelo')->name('eliminarVuelo')->middleware('verified');;
    Route::post('/verBilletes', 'App\Http\Controllers\HomeCompanyController@verBilletes')->name('verBilletes')->middleware('verified');;
    Route::post('/eliminarBillete', 'App\Http\Controllers\HomeCompanyController@eliminarBillete')->name('eliminarBillete')->middleware('verified');;

});


Route::middleware(['auth', 'role:passenger'])->group(function () {
    Route::get('/homePassenger', 'App\Http\Controllers\HomePassengerController@listarVuelosAleatorios')->name('homePassenger')->middleware('verified');;
    Route::post('/getVuelosVuelta', 'App\Http\Controllers\HomePassengerController@getVuelosVuelta')->name('getVuelosVuelta')->middleware('verified');;

//COMPRA
    Route::post('/getBilletesIda', 'App\Http\Controllers\ShoppingController@insertarBilleteIda')->name('getBilletesIda')->middleware('verified');;
    Route::post('/getBilletesVuelta', 'App\Http\Controllers\ShoppingController@insertarBilleteVuelta')->name('getBilletesVuelta')->middleware('verified');;
    Route::post('/getBilletesDatos', 'App\Http\Controllers\ShoppingController@insertarDatosBillete')->name('getBilletesDatos')->middleware('verified');;
    Route::post('/nombresBilletes', 'App\Http\Controllers\ShoppingController@rellenarNombreBilletes')->name('nombresBilletes')->middleware('verified');;
    Route::post('/pagoFinal', 'App\Http\Controllers\ShoppingController@pagarFinal')->name('pagoFinal')->middleware('verified');;
//CARRITO
    Route::get('/billetesPassenger', 'App\Http\Controllers\ShoppingCartController@mostrarBilletesPassenger')->name('billetesPassenger')->middleware('verified');;

    Route::post('/cancelarBillete', 'App\Http\Controllers\ShoppingCartController@cancelarBillete')->name('cancelarBillete')->middleware('verified');;
//CHECK IN
    Route::get('/billetesCheckIn', 'App\Http\Controllers\CheckInController@mostrarBilletesCheckIn')->name('billetesCheckIn')->middleware('verified');;
    Route::post('/checkIn', 'App\Http\Controllers\CheckInController@checkIn')->name('checkIn');
    Route::get('/billetesCheckIn', 'App\Http\Controllers\CheckInController@mostrarBilletesCheckIn')->name('billetesCheckIn')->middleware('verified');;


//RULETA
    Route::get('/ruleta', 'App\Http\Controllers\RuletaController@mostrarRuleta')->name('ruleta')->middleware('verified');;
    Route::post('/premio', 'App\Http\Controllers\RuletaController@generarPremio')->name('premio')->middleware('verified');;
    Route::get('/contacto', 'App\Http\Controllers\ContactController@mostrarcontacto')->name('contacto')->middleware('verified');;
});

Route::get('/', 'App\Http\Controllers\HomePassengerController@listarVuelosAleatorios')->name('homePassenger');
Route::post('/getVuelosIda', 'App\Http\Controllers\HomePassengerController@getVuelosIda')->name('getVuelosIda');
//FORO
Route::get('/foro', 'App\Http\Controllers\ForoController@mostrarTemas')->name('foro');
Route::post('/crearTemas', 'App\Http\Controllers\ForoController@crearTemas')->name('crearTemas')->middleware('verified');
Route::post('/crearMensajes', 'App\Http\Controllers\ForoController@crearMensajes')->name('crearMensajes')->middleware('verified');
Route::match(['get', 'post'], '/mostrarMensajes', [ForoController::class, 'mostrarMensajes'])->name('mostrarMensajes');
//Info
Route::get('info', 'App\Http\Controllers\TerminosController@info')->name('info');
//Contacto
Route::get('contacto', 'App\Http\Controllers\ContactoController@mostrarFormulario')->name('contacto');
Route::post('enviarContacto', 'App\Http\Controllers\ContactoController@enviarFormulario')->name('enviarContacto');

Route::get('/accederHome', 'App\Http\Controllers\HomeController@accederHome')->name('accederHome');


//AUTENTIFICACIÓN
Route::get('register/passenger', 'App\Http\Controllers\Auth\RegisterController@showPassengerRegistrationForm')->name('register.passenger');
Route::post('register/passenger', 'App\Http\Controllers\Auth\RegisterController@registerPassenger')->name('register.passenger.submit');

Route::get('register/company', 'App\Http\Controllers\Auth\RegisterController@showCompanyRegistrationForm')->name('register.company');
Route::post('register/company', 'App\Http\Controllers\Auth\RegisterController@registerCompany')->name('register.company.submit');
Auth::routes(['verify' => true]);
Route::get('terminosycondiciones', 'App\Http\Controllers\TerminosController@terminosyCondiciones')->name('terminosycondiciones');
Route::get('privacidad', 'App\Http\Controllers\TerminosController@privacidad')->name('privacidad');


Route::get('/verify', function () { return view('auth.verify');})->name('verify');

Route::middleware(['auth', 'role:admin'])->group(function () {
    //ZONA ADMIN
    Route::get('/homeAdmin', 'App\Http\Controllers\AdminController@mostrarHomeAdmin')->name('homeAdmin')->middleware('verified');;
    Route::resource('user-passengers', UserPassengerController::class);
    Route::resource('user-companies', UserCompanyController::class);
    //FORO
    Route::post('/eliminarTemas', 'App\Http\Controllers\AdminController@eliminarTemas')->name('eliminarTemas')->middleware('verified');;
    Route::post('/eliminarMensajes', 'App\Http\Controllers\AdminController@eliminarMensajes')->name('eliminarMensajes')->middleware('verified');;

});


