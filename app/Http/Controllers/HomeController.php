<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

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
        //$images = Image::all(); Así funcionaría, sólo que no lo ordenaría
        $images = Image::orderBy('id', 'desc')->Paginate(5);
        return view('home', [
            'images' => $images
        ]);
    }
}
