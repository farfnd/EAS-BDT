<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function show_register()
    {
        return view('pages.register');
    }

    public function show_login()
    {
        return view('pages.login');
    }

    public function create(Request $request)
    {
        // $request->validate([
        //     'nama' => 'required|string|max:100',
        //     'username' => 'required|string|max:25|unique:users',
        //     'email' => 'required|string|email|max:100|unique:users',
        //     'no_telepon' => 'required|regex:/(08)[0-9]{8,12}/',
        //     'password' => ['required', 'confirmed', Password::defaults()],
        // ]);
        // dd($request->except('_token'));
        
        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'password' => Hash::make($request->password),
            'is_admin' => 0,
        ]);

        event(new Registered($user));

        Auth::login($user);
        
        $user_x = User::where('email', $request->email)->firstOrFail();
        $token = $user_x->createToken('auth_token')->plainTextToken;

        session(['Authorization' => 'Bearer '.$token]);

        return redirect(route('home'));
    }

    function login(Request $request){
        $login = request()->input('username');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        // dd($request->except('_token'));

        if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();

            $user = User::where($fieldType, $request->username)->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            session(['Authorization' => 'Bearer '.$token]);

            return redirect(route('home'));
        } else {
            return Redirect::back()->withErrors(['msg' => 'Username atau password salah']);
        }
    }

    function logout(){
        Auth::logout();
        return redirect(route('home'));
    }
}
