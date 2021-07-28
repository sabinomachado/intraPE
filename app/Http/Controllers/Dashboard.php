<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use Illuminate\Http\Request;
use Carbon\Carbon;
use APP\User;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $metas = Meta::where('login', '=', Auth::user()->login )->get();


        return view('estrategico')->with(['metas' => $metas]);


    }


}
