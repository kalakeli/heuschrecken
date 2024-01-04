<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    /**
     * cms
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cms()
    {
        return view('pages.cms');
    }

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
     * Impressum
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function imprint()
    {
        return view('pages.imprint');
    }

    /**
     * Datenschutz
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dsgvo()
    {
        return view('pages.datenscbutt');
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
     * Orthoptera.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function orthopteraweb()
    {
        return view('pages.orthopteraweb');
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

    /**
     *  Welcome-Seite.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        return view('welcome');
    }    
}
