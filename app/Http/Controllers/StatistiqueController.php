<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    function index(){
        return view('/layouts/dashboard');
    }
}
