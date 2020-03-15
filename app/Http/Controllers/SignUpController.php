<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SignUpController
{
    public function index()
    {
        return view('sign-up');
    }

    public  function handle(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        $credentials = $request->only(['email', 'password']);

        $user = new User;
        list($userName, $rest) = explode('@', $credentials['email']);
        $user->name = ucfirst($userName);
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->save();

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
