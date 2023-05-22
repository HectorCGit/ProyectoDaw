<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserCompany;
use App\Models\UserPassenger;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Redirección tras registro
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Mostrar vista de registro de pasajero
     *
     */
    public function showPassengerRegistrationForm()
    {
        return view('auth.registerPassenger');
    }

    /**
     * Mostrar vista de registro de empresa
     *
     */
    public function showCompanyRegistrationForm()
    {
        return view('auth.registerCompany');
    }

    /**
     *
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validación compañía
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorCompany(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telephone'=>['required','min:10000000','max:1000000000','integer'],
        ]);
    }
    /**
     * Validación pasajero
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorPassenger(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telephone'=>['required','min:10000000','max:1000000000','integer'],
            'dni'=>['required','regex:/^[0-9]{8}[A-Z]{1}$/'],
        ]);
    }

    /**
     * Manejar registro de pasajero
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function registerPassenger(Request $request)
    {
        $this->validatorPassenger($request->all())->validate();

        event(new Registered($user = $this->createPassenger($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    /**
     * Manejar registro de compañia
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function registerCompany(Request $request)
    {
        $this->validatorCompany($request->all())->validate();

        event(new Registered($user = $this->createCompany($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    /**
     * Crear nueva empresa
     *
     * @param  array  $data
     * @return \App\Models\UserCompany
     */
    protected function createCompany(array $data)
    {
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
         UserCompany::create([
             'id_users'=>$user->id,
             'name' => $data['name'],
            'telephone' =>$data['telephone']
        ]);
         return $user;
    }
    /**
     * Crear nuevo pasajero
     *
     * @param  array  $data
     * @return \App\Models\UserPassenger
     */
    protected function createPassenger(array $data)
    {
        $user= User::create([
            'name' => $data['name']." ".$data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
         UserPassenger::create([
             'id_users'=>$user->id,
             'name' => $data['name'],
            'surname' => $data['surname'],
            'telephone' =>$data['telephone'],
            'dni' =>$data['dni'],
        ]);
         return $user;
    }
}
