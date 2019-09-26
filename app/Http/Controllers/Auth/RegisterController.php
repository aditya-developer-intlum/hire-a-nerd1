<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Auth;

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
    protected function validator(Request $request)
    {
        return Validator::make($request->all(),[

            "name"=>"required|max:255",
            "email"=>"required|email|max:255|unique:users",
            "password"=>"required|min:8|confirmed:password_confirmation",
            "password_confirmation"=>"required"
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            "term_and_condition"=>1,
        ]);
    }
    public function register(Request $request)
    {
        $validator=$this->validator($request);
        if ($validator->fails())
        {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 201); // 400 being the HTTP code for an invalid request.
        }
        else if(!$request->has('t_and_c'))
        {
            return response()->json(array(
                'success' => false,
                'errors' => ["term_and_condition"=>"Please Accept terms and conditions & privacy policy"]

            ), 201); // 400 being the HTTP code for an invalid request.
        }
        else
        {
            $user=User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>bcrypt($request->password),
            "term_and_condition"=>1,
            ]);

            Auth::login($user);

            Mail::to($request->email)->send(new WelcomeEmail($user));

            return response()->json(array(
                'success' => true

            ), 200);

        }
    }
}
