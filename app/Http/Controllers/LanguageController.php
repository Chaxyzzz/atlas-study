<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller
{
    /**
     * Switch application language locale
     */
    public function switchLanguage(Request $request, $locale)
    {
        if (!in_array($locale, ['id', 'en'])) {
            $locale = 'id';
        }

        session(['locale' => $locale]);

        if (Auth::check()) {
            Auth::user()->update([
                'preferred_language' => $locale,
            ]);
        }

        Cookie::queue('locale', $locale, 60 * 24 * 365);
        App::setLocale($locale);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'locale' => $locale,
                'message' => $locale === 'en' ? 'Language changed to English' : 'Bahasa diubah ke Indonesia',
            ]);
        }

        return redirect()->back();
    }
}
