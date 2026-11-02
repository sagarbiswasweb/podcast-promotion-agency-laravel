<?php

namespace App\Http\Controllers\frontend\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('frontend.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // bcrypt
        ]);

        Auth::login($user); // optional: log the user in after registration

        event(new Registered($user));

        return redirect()->route('verification.notice');
    }

    // The Email Verification Notice
    public function verifyNotice(){
        return view('frontend.auth.verify-email');
    }

    // The Email Verification Handler
    public function verifyEmail(EmailVerificationRequest $request){
        $request->fulfill();
        return redirect()->route('user.dashboard');
    }

    // Resending the Verification Email
    public function verifyHandler (Request $request) {
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Verification link sent!');
    }
}
