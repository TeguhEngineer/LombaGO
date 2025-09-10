<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended($this->redirectTo())->with('login-success', 'Anda berhasil login.');
        }

        // Jika kredensial salah, set pesan error
        return back()->with('login-error', 'Email dan password salah.');
    }

    // Validasi input login
    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8',
            ],
            [
                'email.exists' => 'Email yang anda masukan tidak terdaftar.',
                'password.min' => 'Password minimal 8 karakter.',
            ],
        );
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        // Dapatkan role pengguna yang sedang login
        $role = Auth::user()->role;

        // Pemetaan role ke URL dashboard
        $redirectRoutes = [
            'user' => '/home',
            'superadmin' => '/home',
        ];

        // Redirect ke URL berdasarkan role, atau ke halaman login jika role tidak ditemukan
        return $redirectRoutes[$role] ?? '/login';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
