<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{


    /**
     * Sprache setzen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function languageSwitch(Request $request) 
    {      
        $language = $request->input( key: 'language');

        // store language in session
        session( key: ['language' => $language] );

        app()->setLocale($language);

        return redirect()->back()->with( key: ['language-switched' => $language] );
    }
}
