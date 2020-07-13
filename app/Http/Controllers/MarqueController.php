<?php

namespace App\Http\Controllers;

use App\models\Marque;
use App\models\Modele;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marques = DB::table('marques')
        ->get();
       // dd($marques);
        return view('marque.index', compact('marques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marque.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Gestion d'erreur
        $request->validate([
            'nom_marque' => 'required|min:2|unique:marques',
            'logo' => 'image',
        ]);

       if( $files = $request->file('logo')){
                       // Definir le chemin du fichier
            $destinationPath = public_path('logo_marque/'); // upload path
            $logo = date('dmYHis') . "." . $files->getClientOriginalExtension();

            $files->move($destinationPath, $logo);
            $insert['image'] = $logo;

            //Insertion dans la base de donnees
            $marque = Marque::create([
                'nom_marque' => strtoupper($request->nom_marque),
                'logo' => $logo ?? null
            ]);

            session()->flash('message', "L'automobile ".$request->marque." ".$request->version." a été ajouté avec succès");
            return redirect()->route('marque.index');
       }else{
           session()->flash('message', "Une erreur s'est produite lors de enregistrement de la marque");
            return redirect()->route('marque.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marque = DB::table('marques')
        ->where('id',$id)
        ->join('modeles','modeles.marque_id','=','marques.id')
        ->first();
        return view('marque.edit', compact('marque'));
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
        if(!$request->logo){

            $marque = Marque::where('id', $id)
                    ->update([
                    'nom_marque' => $request->marque,
                    ]);

            if($marque){
            Modele::where('marque_id', $id)
                    ->update([
                    'version' => $request->version,
                    'description' => $request->description,
                    ]);
                    }

                return redirect()->route('marque.index');
        }else{
            ($files = $request->file('logo'));
            // Definir le chemin du fichier
            $destinationPath = public_path('image_auto/'); // upload path
            $logo = date('dmYHis') . "." . $files->getClientOriginalExtension();

            Marque::where('id',$id)
                    ->update([
                        'logo' => $logo,
                    ]);
            $files->move($destinationPath, $logo);
            $insert['image'] = "$logo";
            return redirect()->route('marque.index');
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
        Marque::destroy($id);
        return redirect()->route('marque.index');
    }
}
