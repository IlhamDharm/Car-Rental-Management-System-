<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'alamat' => ['required', 'string'],
            'ktp_file' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'sim_file' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'password' => ['required', 'string'],
        ]);

        $ktpPath = $request->file('ktp_file')->store('profiles/ktp', 'public');
        $simPath = $request->file('sim_file')->store('profiles/sim', 'public');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // otomatis ke-hash
            'role' => 'user',
            'alamat' => $request->alamat,
            'ktp_file' => $ktpPath,
            'sim_file' => $simPath,
            'verification_status' => 'pending',
        ]);

        Auth::login($user);

        return redirect('/email/verify')->with('success', 'Registrasi sukses! Akun Anda sedang dalam proses peninjauan oleh Admin.');
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            // Redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }

            return redirect('/home');
        }

        return back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/home');
    }
}
