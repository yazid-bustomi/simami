<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');

        } elseif(Auth::user()->role == 'perusahaan') {
            return redirect()->route('perusahaan.dashboard');

        } elseif(Auth::user()->role == 'kampus'){
            return redirect()->route('kampus.dashboard');

        }elseif(Auth::user()->role == 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        }else{

        }


    }
}
