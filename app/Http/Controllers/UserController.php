<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('contacts');
        }
        return redirect()->back()->withErrors([
            'credentials' => 'Email or password was incorrect',
        ])->withInput();
    }
    public function registration(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
        if (User::where('email', $request->email)->get()->count() == 0) {
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password, [
                    'rounds' => 12,
                ])
            ]);
            return redirect()->route('register')->with('success', 'Registration successful!');
        } else {
            return redirect()->back()->withErrors(['email' => 'The email is already registered.'])->withInput();
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
