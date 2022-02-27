<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\TryCatch;
use Exception;

class UserController extends Controller
{
    //
    public function index(){
        return view('register');
    }

    public function register(Request $request) {

        // check jika user mau login
        if ($request['emaillogin'] && $request['passwordlogin']) {
            $validate = $request->validate([
            'emaillogin' => 'required|email:dns',
            'passwordlogin' => 'required'
            ]);

            $credential = [
                'email' => $validate['emaillogin'],
                'password' => $validate['passwordlogin']
            ];

            // return 'berhasil login';

            if (Auth::attempt($credential)) {
                $request->session()->regenerate();

                //redirect user jika berhasil login
                return redirect()->intended('/dashboard');
            }

            return back()->with('loginError', "Login failed!");
            
        }

        // proses registrasi user
        $validate = $request->validate([
            'username' => 'required|unique:users|min:5|max:255',
            'email' => 'required|unique:users|email:dns',
            'password' => 'required|min:5'
        ]);

        $validate['password'] = Hash::make($validate['password']);
        
        User::create($validate);

        return redirect('/register')->with('succes', "berhasil registrasi");
    }

    // facebook redirect 
    public function facebookRedirect() {
        return Socialite::driver('facebook')->redirect();
    }

    // facebook callack
    public function facebookCallback() {
        $socialUser = Socialite::driver('facebook')->user(); 
        
        $user = User::where('email', $socialUser->email)->first();

        if (!$user) {
            $user = User::create([
                'username' => $socialUser->name,
                'email' => $socialUser->email,
                'provider_id' => $socialUser->id
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback() {
        $socialUser = Socialite::driver('google')->user(); 
        
        $user = User::where('email', $socialUser->email)->first();

        if (!$user) {
            $user = User::create([
                'username' => $socialUser->name,
                'email' => $socialUser->email,
                'provider_id' => $socialUser->id
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function twitterRedirect() {
        return Socialite::driver('twitter')->redirect();
    }

    public function twitterCallback() {

        $socialUser = Socialite::driver('twitter')->user();
   
        $user = User::where('email', $socialUser->email)->first();

        if ($user) {
            $user->update([
            'username' => $socialUser->name,
            'provider_id' => $socialUser->id,
        ]);
        } else {
            $user = User::create([
                'username' => $socialUser->name,
                'email' => $socialUser->email,
                'provider_id' => $socialUser->id
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}