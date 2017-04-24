<?php

namespace App\Http\Controllers\Auth;

use App\Repository\UserRepository;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'=>'required|email|unique:users,email',
            'firstname'=>'required|max:50|min:2|',
            'lastname'=>'required|max:50|min:2|',
            'level'=>'numeric|min:0|max:9',
            'street'=>'required|max:25',
            'city'=>'required|max:25',
            'tel'=>'required|max:20',
            'password'=>'required|min:6|confirmed',
            'birth'=>'required|date',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'email' => $data['email'],
            'lastname' => $data['lastname'],
            'street' => $data['street'],
            'city' => $data['city'],
            'birth' => $data['birth'],
            'tel' => $data['tel'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
