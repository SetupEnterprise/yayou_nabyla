@extends('master_gerant', ['title' => 'Mon Compte'])
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
                    <h4 class="card-title"> Profil</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                      
                        {{ csrf_field() }}
                        {{ method_field('PUT')}} 
                        <div class="row">
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                    <label>Login</label>
                                    <input type="text" class="form-control" disabled="" value="{{$gerant->login}}">
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label>Prenom</label>
                                    <input type="text" class="form-control" placeholder="" value="{{$gerant->prenom}}" required>
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" class="form-control" placeholder="" value="{{$gerant->nom}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nouveau mot de passe</label>
                                    <input type="password" class="form-control" name="passwd" placeholder="" value="{{$gerant->password}} " disabled> 
                                </div>
                            </div>
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Confirmer mot de passe</label>
                                <input type="password" class="form-control" placeholder="" name="passwd_confirmation" value="{{ old('passwd_confirmation') ?? ''}}"required> 
                                    {!! $errors->first('passwd_confirmation', '<p class="error">:message</p>')!!}
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Nouveau Mot de Passe</label>
                                <input type="password" class="form-control" name="new_password" value="{{ old('new_password') ?? ''}}"> 
                                </div>
                            </div>
                        </div>
                       <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" placeholder="City" value="Mike">
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" class="form-control" placeholder="Country" value="Andrew">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="number" class="form-control" placeholder="ZIP Code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About Me</label>
                                    <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                                </div>
                            </div>
                        </div> -->
                        <input type="submit" class="btn btn-info btn-fill pull-right" value="Mise à jour profil">
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
                                    <img class="avatar avatar-128 img-circle img-thumbnail border-bottom-warning" src="{{ asset('image_auto/goat.jpg') }}" alt="...">
                                <h5 class="title">{{$gerant->prenom}} {{$gerant->nom}}</h5>
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
