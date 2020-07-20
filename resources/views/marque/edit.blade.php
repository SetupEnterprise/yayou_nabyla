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
                <h4 class="card-title"> {{$marque->nom_marque}} {{$marque->version}}</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('marque.update', $marque->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}
                        <div class="row">
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                    <label>Marque</label>
                                <input type="text" class="form-control" name="marque" value="{{$marque->nom_marque}}" required>
                                </div>
                            </div>
                            <div class="col-md-5 px-1">
                                <div class="form-group">
                                    <label>Version</label>
                                    <input type="text" class="form-control" name="version" placeholder="" value="{{$marque->version}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Description</label>
                                <textarea class="form-control" name="description" >{{$marque->description}}</textarea>                         
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pl-1"></div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-info btn-fill pull-right" value="Mise à jour Marque">
                                </div>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-header">
                    <h4 class="card-title"> Logo Marque</h4>
                    </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="author">
                            <a href="#" onclick="">
                                <img class="avatar_auto avatar-150 img-circle img-thumbnail border-bottom-warning" src="/image_auto/{{$marque->logo}}">

                            <h5 class="title"></h5>
                            </a>
                            
                        </div>
                        <form action="{{route('marque.update', $marque->id)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field() }}
                            {{method_field('PUT') }}
                            <input type="file" name="logo" class="btn" required>
                            <input type="submit" class="btn btn-success btn-fill fa-pull-center" value="Modifier photo">
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
