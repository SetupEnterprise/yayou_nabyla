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
                <form action="{{route('gerant.update', $gerant->gerant_id)}}" method="POST">
                    
                        {{ csrf_field() }}
                        {{ method_field('PUT')}} 
                        <div class="row">
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                    <label>Login</label>
                                    <input type="text" name="login" class="form-control" value="{{$gerant->login}}">
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label>Prenom</label>
                                    <input type="text" class="form-control" placeholder="" name="prenom" value="{{$gerant->prenom}}" required>
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" class="form-control" placeholder="" name="nom" value="{{$gerant->nom}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>Confirmer mot de passe</label>
                                <input type="password" class="form-control" placeholder="" name="password_confirmation" value="{{ old('passwd_confirmation') ?? ''}}"required> 
                                </div>
                            </div>
                            <div class="col-md-2 pr-1">
                                <div class="form-group">
                                    <label></label>
                                    <input type="hidden" class="form-control" name="password" placeholder="" value="{{$gerant->password}}"> 
                                    

                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Nouveau Mot de Passe</label>
                                <input type="password" class="form-control" name="new_password" value="{{ old('new_password') ?? ''}}"> 
                                </div>
                            </div>
                            {!! $errors->first('password', '<p style="color: red">:message</p>')!!}
                        </div>
                      
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
                                    <img class="avatar avatar-128 img-circle img-thumbnail border-bottom-warning" src="/image_auto/{{$gerant->photo}}">
                                <h5 class="title">{{$gerant->prenom}} {{$gerant->nom}}</h5>
                                </a>
                               
                            </div>
                            <form method="POST" action="{{route('gerant.update', $gerant->gerant_id)}}" enctype="multipart/form-data">
                              {{csrf_field()}}
                              {{method_field('PUT')}}
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="customFile" name="photo" required>
                                  <label class="custom-file-label" for="customFile">Choisir une photo</label>
                                </div>
                                <input type="submit" class="btn btn-info btn-fill" value="Modifier photo">

                              </form>
                        </div>
                    
                    </div>
                
                </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>   
@endsection
