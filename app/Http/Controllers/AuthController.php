<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->id]);
                }
                Auth::login($user);
                return redirect()->route('home')->with('success', 'Chào mừng bạn quay trở lại, ' . $user->name);
            } else {
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make('vpp@123456'),
                    'email_verified_at' => now(),
                ]);
                Auth::login($newUser);
                return redirect()->route('home')->with('success', 'Tài khoản Google của bạn đã được đăng ký thành công!');
            }
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Không thể kết nối với Google. Vui lòng thử lại.');
        }
    }
}
