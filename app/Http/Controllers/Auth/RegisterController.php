<?php

namespace App\Http\Controllers\Auth;

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
    protected $redirectTo = '/';

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
        $data['email'] = strtolower($data['email']);
        
        return Validator::make($data, [
            'first_name' => ['required', 'regex:/^[a-zA-Z]+(( |-)[a-zA-Z]+)*$/', 'max:100'],
            'last_name' => ['required', 'regex:/^[a-zA-Z]+(( |-)[a-zA-Z]+)*$/', 'max:100'],
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
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
        $data['first_name'] = $this->clean($data['first_name']);
        $data['last_name'] = $this->clean($data['last_name']);
        $data['email'] = strtolower($data['email']);
        
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'full_name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    protected function clean($name) 
    {
        if(strpos($name, '-')) {
            $array = explode('-',$name);
            $string = str_replace(' ', '-', ucwords(strtolower(implode(' ', $array))));
            return $string;
        } else {
            $string = ucwords(strtolower($name));
            return $string;
        } 
    }
}
