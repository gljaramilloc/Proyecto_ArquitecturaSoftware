<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Switch the application locale and store it in the session.
     */
    public function switch(Request $request, string $locale): RedirectResponse
    {
        $availableLocales = ['en', 'es'];

        if (in_array($locale, $availableLocales, true)) {
            $request->session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
