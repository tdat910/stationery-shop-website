<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role == 1) {
                return redirect()->intended('admin.dashboard');
            }

            // Nếu không phải admin, chuyển hướng đến trang chủ hoặc trang dashboard của người dùng
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Thong tin dang nhap khong chinh xac.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth:;logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')
    }
}

