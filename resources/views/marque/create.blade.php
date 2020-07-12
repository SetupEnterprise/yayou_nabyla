@extends('master_gerant', ['title' => 'Ajouter Marque'])

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
            <form method="POST" action="{{route('marque.store')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="column">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Marque</label>
                                    <input type="text" class="form-control" name="marque"  placeholder="marque" value=""  required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Version Modele</label>
                                    <input type="text" class="form-control" name="version"  placeholder="Version Modele" value="" required>
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>logo</label>
                                    <input type="file" class="form-control-file"  name="logo" value=""  aria-describedby="fileHelpId">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description"></textarea>
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
