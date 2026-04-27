<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{
    /**
     * Hiển thị trang đăng nhập.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Hiển thị trang đăng ký.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    protected function googleRedirectUrl()
    {
        return config('services.google.redirect') ?: env('GOOGLE_REDIRECT_URI', 'http://localhost:8000/auth/google/callback');
    }

    /**
     * Trang chủ: Tối ưu hóa truy vấn bằng Eager Loading để tránh lỗi N+1.
     */
    public function home()
    {
        // Lấy tất cả danh mục kèm theo sản phẩm của chúng trong 1 lần truy vấn
        $categories = Category::with(['products' => function($query) {
            $query->latest()->limit(10);
        }])->get();

        $featured_by_category = [];
        $featured_products = collect();

        foreach ($categories as $category) {
            $featured_by_category[$category->id] = $category->products->take(6);
            $featured_products = $featured_products->merge($category->products->take(5));
        }

        return view('home', compact('categories', 'featured_by_category', 'featured_products'));
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Sử dụng updateOrCreate để rút gọn logic và tránh trùng lặp email
            $user = User::updateOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make('vpp@123456'), // Mật khẩu mặc định cho user social
                    'email_verified_at' => now(),
                ]
            );

            Auth::login($user);

            $message = $user->wasRecentlyCreated
                ? 'Tài khoản Google của bạn đã được đăng ký thành công!'
                : 'Chào mừng bạn quay trở lại, ' . $user->name;

            return redirect()->route('home')->with('success', $message);

        } catch (Exception $e) {
            Log::error('Google login error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Không thể kết nối với Google. Vui lòng thử lại.');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Logic phân quyền: Admin redirect về dashboard, User về home
            if (Auth::user()->role === 1) {
                return redirect()->route('admin.dashboard')->with('success', 'Chào mừng Admin ' . Auth::user()->name);
            }

            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Bạn đã đăng xuất thành công.');
    }
}
