<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class TheaterController extends Controller
{
    public function index(Request $request){
        return view('theaters.index');
    }
}
