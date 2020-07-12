@extends('master_gerant', ['title' => 'Ajouter Auto'])

@section('head')
<!--<link href="{{ asset('css/formulaire.css') }}" rel="stylesheet" type="text/css"> -->    
@endsection
    
@section('contenu_page')

<!-- Content Row -->
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Ajouter Automobile</h4>
            </div>
            <div class="card-body">
            <form method="POST" action="{{route('automobile.store')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="column">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Marque</label>
                                   
                                    <select name="marque" class="form-control" >
                                        @foreach ($marques as $item)
                                    <option value="{{$item->nom_marque}}-{{$item->version}}-">{{$item->nom_marque}} - {{$item->version}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Couleur</label>
                                    <select name="couleur" class="form-control" >
                                        @foreach ($couleurs as $item)
                                    <option value="{{$item->nom}}">{{$item->nom}}</option>
                                    @endforeach
                                    </select>                               
                                 </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Annee de sortie</label>
                                    <input type="month" class="form-control" name="sortie" placeholder="annee de sortie"  value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Priorite</label>
                                    <input type="text" class="form-control" name="priorite" placeholder="noter /10 ex: 8/10" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Prix CFA</label>
                                    <input type="number" class="form-control" name="prix"  placeholder="Prix CFA" value="" required>  
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" class="form-control-file"  name="photo" value="" required aria-describedby="fileHelpId">
                                </div>
                            </div>
                        </div>
                      
                        <div class="row">
                            <div class="col-md-2"></div>
                                <button type="submit" class="col-md-8 pr-1 btn btn-info btn-fill pull-right">Enregistrer</button>
                          
                        </div>
                    </div>
                   
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
