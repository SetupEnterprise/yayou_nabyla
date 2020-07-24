<?php

namespace App\Http\Controllers;


use App\models\Couleur;
use Illuminate\Support\Str;
use App\models\Modele;
use App\models\Marque;
use App\models\Automobile;
use App\models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
                        ->join('modeles','automobiles.modele_id','=','modeles.modele_id')
                        ->join('couleurs', 'couleurs.couleur_id', '=', 'automobiles.couleur_id')
                        ->select('automobiles.*', 'marques.*','modeles.*', 'couleurs.*')
                        ->get();
        $taille = count($automobiles);
        //dd($automobiles);

        return view('layouts/index', compact('automobiles', 'taille'));
    }

    public function add_more_img(Request $request)
    {
        //dd($request->automobile_id);
        $this->validate($request, [
        'images'=>'required',
        ]);
        $erreur = 0;
        if($request->hasFile('images'))
        {
            $allowedfileExtension=['jpeg','jpg','png','svg', 'gif', 'webp', 'bmp'];
            $files = $request->file('images');
            foreach($files as $file){
                //$filename = $file->getClientOriginalName();
                $extension = Str::lower($file->getClientOriginalExtension());
                $check = in_array($extension,$allowedfileExtension);
                //dd($check);
                if($check)
                {
                    //array_push($tableau_img, $request->images);
                }
                else
                {
                    $erreur ++;
                }
            }
            if ($erreur > 0) {
                session()->flash('erreur_extension', "Seul ces formats d'images sont pris en chage png, jpg, jpeg, svg, gif, webp, bmp");
                return redirect()->route('automobile.index');
            }else{
                //dd($request->images);
                foreach ($request->images as $photo) {
                    $filename = $photo->store('image_auto');
                    Photo::create([
                        'automobile_id' => $request->automobile_id,
                        'nom_photo' => $filename
                    ]);
                }
                session()->flash('message', "Les images ont été ajouté avec succès");
                return redirect()->route('automobile.index');
            }
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.add');
    }

    public function getCouleurs()
    {
        $couleurs = Couleur::get();
        return response()->json([
            'status' => 'success',
            'couleurs' => $couleurs,
        ], 200);
    }

    public function getMarques()
    {
        $marques = Marque::orderBy('nom_marque','asc')->get();

        return response()->json([
            'status' => 'success',
            'marques' => $marques,
        ], 200);
    }

    public function getModelesMarque ($id){
        $modelesMarque = Modele::where('marque_id', '=', $id)->get();

        return response()->json([
            'status' => 'success',
            'modelesMarque' => $modelesMarque,
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_marque' => 'required',
            'modele' => 'required',
            'couleur' => 'required',
            'sortie' => 'required',
            'priorite' => 'required',
            'prix' => 'required|integer',
            'photo' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 200);
        }

        if ($request->prix <= 0) {
            return response()->json([
                'status' => 'error',
                'errors' => ['prix_null' => ['Le prix de l\'automobile ne peut être null ou négatif']]
            ], 200);
        }

        if ($request->sortie > date('Y')) {
            return response()->json([
                'status' => 'error',
                'errors' => ['date_sortie' => ['L\'année de sortie ne peut être supérieure à '.date('Y')]]
            ], 200);
        }

        if ($request->hasFile('photo'))
        {
            $files = $request->file('photo');
            $allowedfileExtension=['jpeg','jpg','png','svg', 'gif', 'webp', 'bmp'];
            $extension = Str::lower($files->getClientOriginalExtension());
            $check = in_array($extension,$allowedfileExtension);
            if($check)
            {
                 // Definir le chemin du fichier
                $destinationPath = public_path('image_auto/'); // upload path
                $image_auto = date('dmYHis') . "." . $files->getClientOriginalExtension();
                //Insertion dans la base
                //Add table automobiles
                $automobile = Automobile::create([
                    'annee_sortie' => $request->sortie,
                    'estVendu' => false,
                    'date_vente' => null,
                    'prix' => $request->prix,
                    'priorite' => $request->priorite,
                    'couleur_id' => $request->couleur,
                    'marque_id' => $request->nom_marque,
                    'modele_id' => $request->modele,
                    'image_auto' => $image_auto
                ]);

                if($automobile){;
                    //Ecriture du fichier sur disque
                    $files->move($destinationPath, $image_auto);
                    $insert['image'] = "$image_auto";

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Automobile ajouté avec succès'
                    ], 200);
                }
            }else
            {
                return response()->json(
                    [
                        'status' => 'error',
                        'errors' => ['format_img' => [
                            'Veuillez vérifier l\'image. Seul ces formats d\'images sont pris en chage png, jpg, jpeg, svg, gif, webp, bmp']]
                    ], 200);
            }
        }
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
