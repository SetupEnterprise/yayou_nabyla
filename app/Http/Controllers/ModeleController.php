<?php

namespace App\Http\Controllers;

use App\models\Modele;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModeleController extends Controller
{
    public function index()
    {
        $modeles = DB::table('modeles')
        ->join('marques','modeles.marque_id','=','marques.id')
        ->get();
       // dd($modeles);
        return view('modele.index', compact('modeles'));
    }

    public function create()
    {
        $marques = DB::table('marques')
        ->get();
        return view('modele.create', compact('marques'));
    }

    public function store(Request $request)
    {
        //Gestion d'erreur
        $request->validate([
            'nom_marque' => 'required|unique:marques',
            'version' => 'required|min:2|unique:modeles',
        ]);

        //Insertion dans la base de donnees
        $marque = Modele::create([
            'marque_id' => $request->nom_marque,
            'version' => $request->version,
            'description' => $request->description
        ]);

        if ($marque) {
            session()->flash('message', "Le modèl ".$request->version." a été ajouté avec succès");
            return redirect()->route('modele.index');
        }else{
            session()->flash('message', "Une erreur s'est produite lors de l'enregistrement. Veuillez réessayer");
            return redirect()->route('modele.create');
        }



    }
}
