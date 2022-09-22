<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// ? Prendiamo i dati dell'utente loggato
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // ! E' possibile utilizzare questo codice per l'autentifizaione, oppure andare nelle rotte
    // ! e specificarlo lì!
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // ? Prendiamo i dati dell'utente loggato
        $user = Auth::user();
        $id = Auth::id();
        return view('admin.home', compact('id', 'user'));
    }
}
