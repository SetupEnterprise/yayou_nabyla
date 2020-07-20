<?php

namespace App\Http\Controllers;

use App\models\Marque;
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
        $taille = count($modeles);
        return view('modele.index', compact('modeles', 'taille'));
    }

    public function create()
    {
        $marques = Marque::orderBy('nom_marque','asc')->get();
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

    public function update(Request $request, $id){
        $modele = Modele::where('modele_id',$id)->update([
            'version' => $request->version,
            'description' => $request->description
            ]);
            if($modele){
                session()->flash('message', "Le modèle ".$request->version." a été modifié avec succès");
            }
            return redirect()->route('modele.index');
    }

    public function destroy($id){
        $delete = Modele::where('modele_id',$id)->delete();    
        if($delete){
            session()->flash('message', "Le modèle  a été supprimé avec succès");
        }
        return redirect()->route('modele.index');

    }
}
