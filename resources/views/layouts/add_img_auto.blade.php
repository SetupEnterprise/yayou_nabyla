@extends('master_gerant', ['title' => 'Ajouter images'])

@section('head')
{{-- <!--<link href="{{ asset('css/formulaire.css') }}" rel="stylesheet" type="text/css"> -->
 --}}
@endsection

@section('contenu_page')

<!-- Content Row -->
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Ajouter plus d'images {{  $marqueModele->nom_marque }} - {{ $marqueModele->version }}</h4>
            </div>
            <div class="card-body">
            <form method="POST" action="{{route('automobile.store')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="column">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Images (Choisissez un ou plusieurs images)</label>
                                    <i class="fas fa-images"></i>
                                    <input type="file" class="form-control" name="images[]" multiple>
                                    @if ($errors->has('images'))
                                        <span class="custom-control-description text-danger">
                                            {{ $errors->first('images')}}
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
