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
        return view('pages.datenschutz');
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
    public function en_methods()
    {
        return view('pages.en.methodlist');
    }

    /**
     * Orthoptera.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function orthopteraweb()
    {
        return view('pages.orthoptera_web');
    }

    /**
     * Orthoptera.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function en_orthopteraweb()
    {
        return view('pages.en.orthoptera_web');
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
     * Hier landen Unterseiten von Projekten und werden von dort weitergeleitet.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function en_projects()
    {
        return view('pages.en.projectlist');
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
     * Hier landen Unterseiten von Arten und werden von dort weitergeleitet.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function en_species()
    {
        return view('pages.en.specieslist');
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
