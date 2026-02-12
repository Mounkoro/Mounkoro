<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ClientProfile;
use App\Models\EngineerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'engineer') {
                return redirect()->intended('engineer/dashboard');
            }
            return redirect()->intended('client/dashboard');
        }

        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:client,engineer',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role === 'client') {
            ClientProfile::create(['user_id' => $user->id]);
        } else {
            EngineerProfile::create(['user_id' => $user->id]);
        }

        Auth::login($user);

        if ($user->role === 'engineer') {
            return redirect('engineer/dashboard');
        }
        return redirect('client/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
