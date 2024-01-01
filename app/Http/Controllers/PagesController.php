<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    /**
     * Ziel, wenn irgendein Unsinn eingegeben wurde.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function error()
    {
        return view('pages.errorpage');
    }

    /**
     * Startseite, ebenso das Ziel, wenn irgendein Unsinn eingegeben wurde.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function initial()
    {
        return view('welcome');
    }

    /**
     * Hier landen Unterseiten von Projekten und werden von dort weitergeleitet.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function methods()
    {
        return view('pages.methodikliste');
    }

    /**
     * Hier landen Unterseiten von Projekten und werden von dort weitergeleitet.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function projects()
    {
        return view('pages.projektliste');
    }

    /**
     * Hier landen Unterseiten von Arten und werden von dort weitergeleitet.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function species()
    {
        return view('pages.artenliste');
    }    
}
