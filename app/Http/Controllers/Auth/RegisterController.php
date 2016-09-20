<?php

namespace App\Http\Controllers\Auth;

use App\Mail\RegisterConfirmation;
use App\Entities\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Illuminate\Http\Request;
use Redirect;
use Session;
use App\Repositories\UserRepository;
use Lang;
use Illuminate\Support\Facades\Auth;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('guest');
    }

    protected function guard()
    {
        return Auth::guard('front');
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

//        return redirect($this->redirectPath());
        return redirect()->route('login');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $confirmationCode = str_random(40);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_code' => $confirmationCode
        ]);

        Mail::to($data['email'])->send(new RegisterConfirmation($user));

        Session::flash('flash_message', Lang::get('auth.thanks-check-email'));

    }

    public function confirm($token, UserRepository $repository) {

        $user = $repository->getUserToConfirm($token);
        if($user) {
            $user->active = 1;
            $user->verified = 1;
            $user->confirmation_code = null;
            $user->save();

            Session::flash('flash_message', Lang::get('auth.email-confirm-successful'));
        } else {
            Session::flash('flash_message', Lang::get('auth.invalid-confirmation-link'));
        }
        return redirect()->route('login');
    }
}
