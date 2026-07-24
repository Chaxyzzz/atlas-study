<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = trim($credentials['username']);
        $password = $credentials['password'];

        $authSuccess = Auth::attempt(['email' => $loginInput, 'password' => $password]) 
                    || Auth::attempt(['username' => $loginInput, 'password' => $password]);

        if ($authSuccess) {
            $user = Auth::user();
            
            if (!$user->isActive()) {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Your account has been deactivated.',
                ]);
            }

            if ($user->isAdmin()) {
                $user->recordLogin($request, 'local');
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }
            
            Auth::logout();
            return back()->withErrors([
                'username' => 'You do not have admin privileges.',
            ]);
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
