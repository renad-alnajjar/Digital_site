<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class digitalController extends Controller
{
    //
    public function index(){

        return view('digital.home');
    }
}
