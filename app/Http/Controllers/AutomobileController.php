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
                        ->join('marques','automobiles.marque_id','=','marques.id')
                        ->join('modeles','modeles.marque_id','=','marques.id')
                        ->join('couleurs', 'couleurs.couleur_id', '=', 'automobiles.couleur_id')
                        ->join('photos', 'photos.automobile_id', '=', 'automobiles.id')
                        ->get(['automobiles.id','marques.nom_marque','version', 'prix', 'priorite','estVendu', 'annee_sortie']);

        foreach($automobiles as $auto){
            $auto->priorite = ((int)$auto->priorite*100)/10;
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

        $marques = DB::table('marques')
                ->join('modeles','modeles.marque_id','=','marques.id')
                ->get();
        //dd($marques);
        $couleurs = Couleur::all();
        return view('layouts/add', compact('marques', 'couleurs'));
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        dd('select '.$select.' value '.$value.' dependent '.$dependent);
        $data = DB::table('modeles')
            ->where($select, $value)
            ->groupBy($dependent)
            ->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach ($data as $row) {
            $output .= '<option value="'.$row->dependent.'">'.$row->dependent.'</option>';
        }
        echo $output;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(date('Y'));
        //dd($request->sortie.' '.date('Y'));
        if ($request->sortie > date('Y')) {
            return back()->with('sortie', "L'année de sortie ne peut être supérieure à ".date('Y'));
        }
        $this->validate($request,[
            'nom_marque' => 'required',
            'modele' => 'required',
            'couleur' => 'required',
            'sortie' => 'required',
            'priorite' => 'required',
            'prix' => 'required|integer',
            'photo' => 'required|image',
        ]);

            $files = $request->file('photo');
            // Definir le chemin du fichier
            $destinationPath = public_path('image_auto/'); // upload path
            $image_auto = date('dmYHis') . "." . $files->getClientOriginalExtension();
            //Pour voir le couleur choisi
            $couleur = Couleur::where('nom', $request->couleur)->first();
            //Avoir l'ID marque
            $str = strtok($request->marque, "-");
            $marque = $str;
            $version = $str = strtok("-");

            $marque = DB::table('marques')
                ->where('nom_marque',$marque)
                ->join('modeles','modeles.marque_id','=','marques.id')
                ->where('modeles.version', $version)
                ->first();
            //Creation d'automobile
            if($marque->id && $couleur){
                $automobile = Automobile::create([

                    'annee_sortie' => (int)substr($request->annee_sortie,-4),
                    'estVendu' => false,
                    'date_vente' => null,
                    'prix' => $request->prix,
                    'priorite' => $request->priorite,
                    'couleur_id' => $couleur->couleur_id,
                    'marque_id' => $marque->id
                ]);
            }
            if($automobile){
                $photo = Photo::create([
                    'photo_profil' => $image_auto,
                    'automobile_id' => $automobile->id
                ]);
            }

            $files->move($destinationPath, $image_auto);
            $insert['image'] = "$image_auto";
            session()->flash('message', "L'automobile ".$request->marque." ".$request->version." a été ajouté avec succès");
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
                ->join('marques','automobiles.marque_id','=','marques.id')
                ->join('modeles','modeles.marque_id','=','marques.id')
                ->join('couleurs', 'couleurs.couleur_id', '=', 'automobiles.couleur_id')
                ->join('photos', 'photos.automobile_id', '=', 'automobiles.id')
                ->first(['automobiles.id','nom_marque','version', 'prix', 'priorite','estVendu', 'annee_sortie','nom','date_vente','description','photo_profil']);
        $couleurs = Couleur::all();
        return view('layouts.edit', compact('automobile','couleurs'));
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
            //dd($request->prix);
            $couleur = Couleur::where('nom', $request->couleur)->first();
            Automobile::where('id', $id)
                        ->update([
                        'annee_sortie' => $request->annee_sortie,
                        'estVendu' => $request->estVendu,
                        'date_vente' => $request->date_vente,
                        'prix' => $request->prix,
                        'priorite' => $request->priorite,
                        'couleur_id' => $couleur->couleur_id
                        ]);


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

        Automobile::destroy($id);

        session()->flash('message', "La suppression s'est effectuee avec succes");
        return redirect()->route('automobile.index');
    }
}
