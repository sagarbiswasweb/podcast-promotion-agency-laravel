<?php

namespace App\Http\Controllers\frontend\auth;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('frontend.auth.login');
    }

    public function login(Request $request) {
        // Step 1: Validate inputs separately
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6', // you can adjust min length
        ]);

        // Step 2: Attempt login
        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            return redirect()->intended(route('user.dashboard'));
        }

        // Step 3: Return with login error
        return back()->withErrors([
            'loginError' => 'Invalid username or password',
        ])->withInput(); // optional: keeps entered email
    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
