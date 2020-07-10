<?php

namespace App\Http\Controllers;

use App\Http\Requests\GerantFormRequest;
use App\models\Gerant;
use App\models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class GerantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gerant = Gerant::first();
       // dd($gerant->gerant_id);
        return view('layouts.account', compact('gerant'));
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
        if(!$request->photo){
        $this->validate($request, [
            'password' => 'confirmed',
        ]);
        
            if($request->new_password != null){
                Gerant::where('gerant_id', $id)
                    ->update([
                        'login' => $request->login,
                        'nom' => $request->nom,
                        'prenom' => $request->prenom,
                        'password' => $request->new_password
                    ]);
            }else{
                Gerant::where('gerant_id', $id)
                    ->update([
                        'login' => $request->login,
                        'nom' => $request->nom,
                        'prenom' => $request->prenom,
                    ]);
            }
            session()->flash('message', "La modification s'est effectuee avec succes!");
        }else{
            
            ($files = $request->file('photo'));
            // Definir le chemin du fichier
            $destinationPath = public_path('image_auto/'); // upload path
            $image_auto = date('dmYHis') . "." . $files->getClientOriginalExtension();
            Gerant::where('gerant_id',$id)
                    ->update([
                        'photo' => $image_auto,
                    ]);
            $files->move($destinationPath, $image_auto);
            $insert['image'] = "$image_auto";
            session()->flash('message', "La modification s'est effectuee avec succes!");

        }
            return redirect()->route('gerant.index');
            
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function dashboard(){
        return view('layouts.dashboard');
    }
}
