@extends('master_gerant', ['title' => 'Automobiles'])
@section('head')
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" /> 
<link href="{{asset('css/add_design_gerant.css')}} " rel="stylesheet" /> 

@endsection
@section('contenu_page')

<!-- Content Row -->
    <div class="row">
       
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title"> Automobile {{$automobile->nom_marque}} {{$automobile->version}}</h4>
                </div>
                <div class="card-body">
                <form action="{{route('automobile.update', $automobile->id)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                    <label>Marque</label>
                                <input type="text" class="form-control" name="marque" value="{{$automobile->nom_marque}}" required>
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label>Version</label>
                                    <input type="text" class="form-control" name="version" placeholder="" value="{{$automobile->version}}" required>
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Annee sortie</label>
                                <input type="text" class="form-control" name="annee_sortie" placeholder="" value="{{$automobile->annee_sortie}}" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Prix</label>
                                <input type="text" class="form-control" name="prix" placeholder="" value="{{$automobile->prix}}" required onchange=" name= 'prixchange'"> 
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Couleur</label>
                                    <input type="text" class="form-control" name="couleur" value="{{$automobile->nom}}" required> 
                                </div>
                            </div>
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Priorite</label>
                                <input type="text" class="form-control" placeholder="" name="priorite" value="{{$automobile->priorite}}" required> 
                                    {!! $errors->first('passwd_confirmation', '<p class="error">:message</p>')!!}
                                </div>
                            </div>
                           
                        </div>
                        <div class="row"> 
                            <div class="col-md-2 pl-1"></div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Date de la vente</label>
                                <input type="date" class="form-control" name="dateVente" value="{{$automobile->date_vente}}"> 
                                </div>
                            </div>
                            <div class="col-md-1 pl-1"></div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Est-il vendu?</label>
                                <input type="text" class="form-control" name="estVendu" value="{{$automobile->estVendu}}"> 
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-3 pl-1"></div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Description</label>
                                <textarea class="form-control" name="description" >{{$automobile->description}}</textarea>                         
                                </div>
                            </div>
                            <div class="col-md-3 pl-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pl-1"></div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-info btn-fill pull-right" value="Mise à jour Automobile">
                                 </div>
                        </div>
                       
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                    
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="author">
                            <a href="#" onclick="">
                                <img class="avatar_auto avatar-150 img-circle img-thumbnail border-bottom-warning" src="/image_auto/{{$automobile->photo_profil}}">
                            <h5 class="title"></h5>
                            </a>
                            
                            <button type="submit" class="btn btn-info btn-fill pull-right">Modifier photo</button>
                        </div>
                    </div>
                
                </div>
            
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>   
@endsection
