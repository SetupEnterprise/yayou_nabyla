<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReactAutomobileController extends Controller
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
                        ->join('photos', 'photos.automobile_id', '=', 'automobiles.id')
                        ->take(6)
                        ->get();

        $nbre_auto = DB::table('automobiles')
                        ->get();

        //Reponse coté React
        return response()->json([
            'status' => 'success',
            'automobiles' => $automobiles,
            'nbre_auto' => count($nbre_auto)
        ], 200);
    }

    public function trie_par_prix()
    {
        $automobiles = DB::table('automobiles')
                ->join('marques','automobiles.marque_id','=','marques.id')
                ->join('modeles','automobiles.modele_id','=','modeles.modele_id')
                ->join('couleurs', 'couleurs.couleur_id', '=', 'automobiles.couleur_id')
                ->join('photos', 'photos.automobile_id', '=', 'automobiles.id')
                ->orderBy('automobiles.prix', 'asc')
                ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
