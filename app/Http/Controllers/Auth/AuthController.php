<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Storage;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = trim($value, " ");
        }
        return Validator::make($data, [
            'first_name' => 'required|alpha|max:50',
			'last_name' => 'required|alpha|max:50',
            'birthday' => 'required',
            'gender' => 'required',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
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
        $default_picture = '/img/default-pic.png';
        $create_user_folder = $data['username'];

        if (!'users/' . $create_user_folder) {
            mkdir('users/' . $create_user_folder);
        }

        return User::create([
            'first_name' => ucwords($data['first_name']),
			'last_name' => ucwords($data['last_name']),
            'birthday' => $data['birthday'],
			'gender' => $data['gender'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'profile_pic' => $default_picture,
        ]);

    }
}
