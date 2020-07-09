<?php

namespace App\Http\Controllers;


use App\models\Couleur;
use App\Http\Requests\AutomobileFormRequest;
use App\models\Modele;
use App\models\Marque;
use App\models\Automobile;
use App\models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutomobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $automobiles = DB::table('automobiles')
                        ->join('marques','automobiles.id','=','marques.automobile_id')
                        ->join('modeles','modeles.marque_id','=','marques.id')
                        ->join('couleurs', 'couleurs.automobile_id', '=', 'automobiles.id')
                        ->join('photos', 'photos.automobile_id', '=', 'automobiles.id')
                        ->get();
        foreach($automobiles as $auto){
            $auto->priorite = ((int)$auto->priorite*100)/10;
            //dd($auto);
        }
        return view('layouts/index', compact('automobiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            ($files = $request->file('photo'));
            // Definir le chemin du fichier
            $destinationPath = public_path('image_auto/'); // upload path
            $image_auto = date('dmYHis') . "." . $files->getClientOriginalExtension();
            
            $automobile = Automobile::create([

                'annee_sortie' => 2014,
                'estVendu' => false,
                'date_vente' => null,
                'prix' => $request->prix,
                'priorite' => $request->priorite
            ]);
            if($automobile){
                $marque = Marque::create([
                    'nom_marque' => $request->marque,
                    'automobile_id' => $automobile->id
                ]);
                $couleur = Couleur::create([
                    'nom' => $request->couleur,
                    'automobile_id' => $automobile->id
                ]);
                $photo = Photo::create([
                    'photo_profil' => $image_auto,
                    'automobile_id' => $automobile->id
                ]);
            }
            if($marque){
                $modele = Modele::create([
                    'version' => $request->version,
                    'description' => $request->description,
                    'marque_id' => $marque->id
                ]);
            }
            $files->move($destinationPath, $image_auto);
            $insert['image'] = "$image_auto";

    
        return redirect()->route('automobile.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $automobile = DB::table('automobiles')
                ->where('automobiles.id',$id)
                ->join('marques','automobiles.id','=','marques.automobile_id')
                ->join('modeles','modeles.marque_id','=','marques.id')
                ->join('couleurs', 'couleurs.automobile_id', '=', 'automobiles.id')
                ->join('photos', 'photos.automobile_id', '=', 'automobiles.id')
                
                ->first();
        return view('layouts.edit', compact('automobile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        if(!$request->photo){
            $marque_id = Marque::where('automobile_id', $id)->first('id');        
            //dd($request->prix);
            Automobile::where('id', $id)
                        ->update([
                        'annee_sortie' => $request->annee_sortie,
                        'estVendu' => $request->estVendu,
                        'date_vente' => $request->date_vente,
                        'prix' => $request->prix,
                        'priorite' => $request->priorite
                        ]);
            
            Marque::where('automobile_id', $id)
                    ->update([
                    'nom_marque' => $request->marque,
                    ]);
            Couleur::where('automobile_id',$id)
                    ->update([
                    'nom' => $request->couleur,
                    ]);
                    if($marque_id){
            Modele::where('marque_id', $marque_id->id)
                    ->update([
                    'version' => $request->version,
                    'description' => $request->description,
                    ]);
                    }
        /*      
        Photo::where('automobile_id',$id)
                    ->update([
                        'photo_profil' => ,
                    ]);
                }*/
                return redirect()->route('automobile.index');
        }else{
            ($files = $request->file('photo'));
            // Definir le chemin du fichier
            $destinationPath = public_path('image_auto/'); // upload path
            $image_auto = date('dmYHis') . "." . $files->getClientOriginalExtension();

            Photo::where('automobile_id',$id)
                    ->update([
                        'photo_profil' => $image_auto,
                    ]);
            $files->move($destinationPath, $image_auto);
            $insert['image'] = "$image_auto";
            return redirect()->route('automobile.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
