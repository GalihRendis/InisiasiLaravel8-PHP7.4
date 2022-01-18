<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function viewLogin(){
        return view('si.login');
    }

    public function attemptLogin(Request $request){

        $credentials = $request->only('email', 'password', 'remember');

        if(Auth::attempt([
            'email' => $credentials['email'] ?? null,
            'password' => $credentials['password'] ?? null],
            !empty($credentials['remember']))){

            return redirect()->intended('/home');
        }
        return redirect()->back()->withInput()
        ->with('error','Email-Address Or Password Are Wrong.');
    }

    public function attemptRegister(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'],
        ]);
          // dd($request->all());
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if(Auth::attempt([
            'email' => $request->email ?? null,
            'password' => $request->password ?? null])){

            return redirect()->route('home');
        }
        return redirect()->route('login')
        ->with('error','Email-Address Or Password Are Wrong.');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('register');
    }

    public function viewRegister() {
       return view('si.register');
    }
}
