<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Change the application language
     */
    public function change(Request $request)
    {
        $locale = $request->input('locale', 'en');

        // Supported languages
        $supportedLocales = ['en', 'km', 'ja', 'zh-CN'];

        // Validate locale
        if (!in_array($locale, $supportedLocales)) {
            $locale = 'en';
        }

        // Store in session
        Session::put('locale', $locale);
        App::setLocale($locale);

        // Add flash message for debugging
        Session::put('locale_changed', $locale);

        // Redirect back
        return redirect()->back();
    }
}
