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
                <h4 class="card-title"> Ajouter un modèl de véhicule</h4>
            </div>
            <div class="card-body">
            <form method="POST" action="{{route('modele.store')}}">
                {{ csrf_field() }}
                    <div class="column">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                  <label for="">Marque</label>
                                  <select class="form-control" name="nom_marque">
                                    <option>Sélectionnez une marque</option>
                                    @foreach ($marques as $marque)
                                        <option value="{{ $marque->id }}">{{ $marque->nom_marque }}</option>
                                    @endforeach
                                  </select>
                                    @if ($errors->has('nom_marque'))
                                        <span class="custom-control-description text-danger">
                                            {{ $errors->first('nom_marque')}}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Modèl</label>
                                    <input type="text" class="form-control" name="version"  placeholder="Saisir le modèl de véhicule" >
                                    @if ($errors->has('version'))
                                        <span class="custom-control-description text-danger">
                                            {{ $errors->first('version')}}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea
                                        class="form-control" name="description"
                                        placeholder="Saisir la description du véhicule" value={{ old('description') }}>
                                    </textarea>
                                    @if ($errors->has('description'))
                                        <span class="custom-control-description text-danger">
                                            {{ $errors->first('description')}}
                                        </span>
                                    @endif
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
