<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class UserController extends Controller
{


    /**
     * Sprache setzen.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getUser($id) 
    {      
        return User::findOrFail($id); 
    }
}
