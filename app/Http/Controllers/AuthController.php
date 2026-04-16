<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Exception;

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

    protected function googleRedirectUrl()
    {
        return config('services.google.redirect') ?: env('GOOGLE_REDIRECT_URI');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Đăng xuất thành công!');
    }

    public function home()
    {
        $categories = Category::all();
        $featured_by_category = [];
        $featured_products = collect();

        foreach ($categories as $category) {
            $featured_by_category[$category->id] = $category->products()->take(6)->get();
            $featured_products = $featured_products->merge($category->products()->take(5)->get());
        }

        return view('home', compact('categories', 'featured_by_category', 'featured_products'));
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->redirectUrl($this->googleRedirectUrl())
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->redirectUrl($this->googleRedirectUrl())
                ->user();
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
            // Log the error for debugging
            \Log::error('Google login error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Không thể kết nối với Google. Vui lòng thử lại.');
        }
    }

    public function login()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            // Kiểm tra nếu user là admin thì redirect về admin dashboard
            if (Auth::user()->role == 1) {
                return redirect()->route('admin.dashboard')->with('success', 'Chào mừng Admin ' . Auth::user()->name);
            }

            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    public function register()
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 0, // Default user role
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Đăng ký tài khoản thành công!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Bạn đã đăng xuất thành công.');
    }
}
