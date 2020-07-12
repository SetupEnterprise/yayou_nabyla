<?php

namespace App\Http\Controllers;

use App\models\Automobile;
use App\models\Gerant;
use App\models\Marque;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    function index(){
        $nbr_auto = Automobile::count();
        $nbr_marque = Marque::count();
        return view('layouts.dashboard', compact('nbr_auto', 'nbr_marque'));
        
    }
    function login(){
        return view('layouts.gerant_login');

    }
    function login_store(Request $request){
       
        $this->validate($request, [
            'password' => 'required',
            'login' => 'required'
        ]);
        $gerant = Gerant::where('login',$request->login)->where('password', $request->password)->first();
        if($gerant != null){
            session(['user'=> $gerant]);
           // dd(session('user'));
            return redirect()->route('gerant.dashboard');
        }
        else{
            session()->flash('erreur', 'Veuillez revoir vos parametres de connexion, elle a echoue!');
            return redirect()->route('login');
        }
    }
    function disconnect(Request $request){
        session()->forget('user');
        return view('layouts.gerant_login');
    }
}
