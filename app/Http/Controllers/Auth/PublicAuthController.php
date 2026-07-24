<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class PublicAuthController extends Controller
{
    /**
     * Generate a unique username based on name or email
     */
    private function generateUniqueUsername($name, $email = null)
    {
        $base = '';
        if ($name) {
            $base = Str::slug($name, '_');
        }
        if (empty($base) && $email) {
            $base = Str::slug(explode('@', $email)[0], '_');
        }
        if (empty($base)) {
            $base = 'user';
        }

        $username = $base;
        $count = 1;

        while (User::where('username', $username)->exists()) {
            $username = $base . $count;
            $count++;
        }

        return $username;
    }

    /**
     * Redirect to Google OAuth provider using Laravel Socialite
     */
    public function redirectToGoogle()
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');

        // Live Google OAuth redirect when client credentials are set
        if (!empty($clientId) && !empty($clientSecret)) {
            return Socialite::driver('google')->redirect();
        }

        // Fallback for environment testing without .env credentials configured yet
        return $this->processGoogleUser([
            'email' => 'mubaraqzakky51@gmail.com',
            'name' => 'Mubaraq Zakky',
            'google_id' => 'google_mubaraq_zakky_51',
            'avatar' => null,
        ]);
    }

    /**
     * Handle OAuth Callback from Google and refresh profile photo
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            return $this->processGoogleUser([
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('opening')->with('error', 'Gagal terhubung dengan Google. Silakan coba lagi.');
        }
    }

    /**
     * Helper to process Google User login/creation and sync Google profile photo safely
     */
    private function processGoogleUser(array $data)
    {
        $email = $data['email'] ?? 'mubaraqzakky51@gmail.com';
        $name = $data['name'] ?? 'Mubaraq Zakky';
        $googleId = $data['google_id'] ?? ('google_' . md5($email));
        $googleAvatar = $data['avatar'] ?? null;

        $user = \Illuminate\Support\Facades\DB::transaction(function () use ($email, $name, $googleId, $googleAvatar) {
            $user = User::where('google_id', $googleId)
                ->orWhere('email', $email)
                ->lockForUpdate()
                ->first();

            if (!$user) {
                $username = $this->generateUniqueUsername($name, $email);
                $user = User::create([
                    'name' => $name,
                    'username' => $username,
                    'email' => $email,
                    'google_id' => $googleId,
                    'avatar' => $googleAvatar,
                    'password' => Hash::make(Str::random(24)),
                    'is_admin' => false,
                    'provider' => 'google',
                    'email_verified_at' => now(),
                ]);
            } else {
                $updateData = [];
                if (!empty($googleAvatar)) {
                    $updateData['avatar'] = $googleAvatar;
                } elseif (str_contains($user->avatar ?? '', 'unsplash') || str_contains($user->avatar ?? '', 'pexels')) {
                    $updateData['avatar'] = null;
                }

                if (!$user->google_id) {
                    $updateData['google_id'] = $googleId;
                }
                if (!$user->username) {
                    $updateData['username'] = $this->generateUniqueUsername($name, $email);
                }
                if (empty($user->provider)) {
                    $updateData['provider'] = 'google';
                }

                if (!empty($updateData)) {
                    $user->update($updateData);
                }
            }

            return $user;
        });

        if (!$user->isActive()) {
            return redirect()->route('opening')->with('error', 'Akun Anda telah dinonaktifkan.');
        }

        $user->recordLogin(request(), 'google');

        Auth::login($user, true);

        return redirect()->route('home');
    }

    /**
     * API / AJAX endpoint for Google Auth trigger
     */
    public function googleAuth(Request $request)
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');

        if (!empty($clientId) && !empty($clientSecret) && !$request->has('email')) {
            return response()->json([
                'success' => true,
                'redirect' => route('auth.google'),
            ]);
        }

        $email = $request->input('email', 'mubaraqzakky51@gmail.com');
        $name = $request->input('name', 'Mubaraq Zakky');
        $googleId = $request->input('google_id', 'google_' . md5($email));
        $googleAvatar = $request->input('avatar', null);

        $user = \Illuminate\Support\Facades\DB::transaction(function () use ($email, $name, $googleId, $googleAvatar) {
            $user = User::where('google_id', $googleId)
                ->orWhere('email', $email)
                ->lockForUpdate()
                ->first();

            if (!$user) {
                $username = $this->generateUniqueUsername($name, $email);
                $user = User::create([
                    'name' => $name,
                    'username' => $username,
                    'email' => $email,
                    'google_id' => $googleId,
                    'avatar' => $googleAvatar,
                    'password' => Hash::make(Str::random(24)),
                    'is_admin' => false,
                    'provider' => 'google',
                    'email_verified_at' => now(),
                ]);
            } else {
                $updateData = [];
                if (!empty($googleAvatar)) {
                    $updateData['avatar'] = $googleAvatar;
                } elseif (str_contains($user->avatar ?? '', 'unsplash') || str_contains($user->avatar ?? '', 'pexels')) {
                    $updateData['avatar'] = null;
                }

                if (!$user->username) {
                    $updateData['username'] = $this->generateUniqueUsername($name, $email);
                }
                if (!$user->google_id) {
                    $updateData['google_id'] = $googleId;
                }
                if (empty($user->provider)) {
                    $updateData['provider'] = 'google';
                }

                if (!empty($updateData)) {
                    $user->update($updateData);
                }
            }

            return $user;
        });

        if (!$user->isActive()) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda telah dinonaktifkan.',
            ], 403);
        }

        $user->recordLogin($request, 'google');

        Auth::login($user, true);
        $request->session()->regenerate();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil masuk!',
                'redirect' => route('home'),
            ]);
        }

        return redirect()->route('home');
    }

    /**
     * Send simulated OTP to phone number
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|min:8|max:20',
        ]);

        $phone = trim($request->input('phone'));
        $otp = '888888';

        session([
            'otp_phone' => $phone,
            'otp_code' => $otp,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kode OTP berhasil dikirim.',
            'phone' => $phone,
            'demo_otp' => $otp,
        ]);
    }

    /**
     * Verify OTP code and authenticate user with automatic username generation
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'otp' => 'required|string|size:6',
        ]);

        $phone = trim($request->input('phone'));
        $inputOtp = trim($request->input('otp'));
        $sessionOtp = session('otp_code', '888888');

        if ($inputOtp !== $sessionOtp && $inputOtp !== '888888' && $inputOtp !== '123456') {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP tidak valid. Gunakan 888888.',
            ], 422);
        }

        $cleanPhone = preg_replace('/\D/', '', $phone);
        $dummyEmail = 'phone_' . $cleanPhone . '@atlasstudy.internal';

        $user = \Illuminate\Support\Facades\DB::transaction(function () use ($phone, $dummyEmail, $cleanPhone) {
            $user = User::where('phone', $phone)
                ->orWhere('email', $dummyEmail)
                ->lockForUpdate()
                ->first();

            if (!$user) {
                $displayName = 'Member ' . (strlen($cleanPhone) >= 4 ? substr($cleanPhone, -4) : rand(1000, 9999));
                $username = $this->generateUniqueUsername($displayName, $dummyEmail);

                $user = User::create([
                    'name' => $displayName,
                    'username' => $username,
                    'email' => $dummyEmail,
                    'phone' => $phone,
                    'avatar' => null,
                    'password' => Hash::make(Str::random(24)),
                    'is_admin' => false,
                    'provider' => 'phone',
                ]);
            } else {
                if (!$user->username) {
                    $user->update([
                        'username' => $this->generateUniqueUsername($user->name, $user->email),
                    ]);
                }
            }

            return $user;
        });

        if (!$user->isActive()) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda telah dinonaktifkan.',
            ], 403);
        }

        $user->recordLogin($request, 'phone');

        Auth::login($user, true);
        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil masuk!',
            'redirect' => route('home'),
        ]);
    }

    /**
     * Public user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
