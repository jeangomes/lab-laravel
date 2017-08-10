<?php

namespace Confee\Units\Authentication\Http\Controllers;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Confee\Domains\Users\User;
use Confee\Support\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');


        $view_log = new Logger("SQL");
        $view_log->pushHandler(
                new StreamHandler(storage_path() . '/logs/sql.log')
        );
        $view_log->addInfo('log teste');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Confee\User
     */
    protected function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'sexo' => $data['sexo'],
                    'password' => bcrypt($data['password']),
        ]);
    }

    protected function users() {
        return User::all();
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);
        try {
            $token = app('tymon.jwt.auth')->fromUser($user);
        } catch (Exception $ex) {
            return response()->json(['error generating token'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json(['token' => $token], Response::HTTP_CREATED);
    }

}
