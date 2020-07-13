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

                                    <select name="nom_marque" class="form-control" onchange="showCustomer(this.value)">
                                        <option>Veuillez sélectionner une marque</option>
                                        @foreach ($marques as $item)
                                            <option value="{{$item->marque_id}}-">{{$item->nom_marque}}</option>
                                        @endforeach
                                        @if ($errors->has('nom_marque'))
                                            <span class="custom-control-description text-danger">
                                                {{ $errors->first('nom_marque')}}
                                            </span>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-md-2'></div>
                            <div class='col-md-8 pr-1'>
                                <div class='form-group'>
                                    <label>Modèl</label>
                                    <select name='modele' class='form-control'>
                                        @foreach ($marques as $item)
                                            <option value="{{$item->modele_id}}">{{$item->version}}</option>
                                        @endforeach
                                        @if ($errors->has('modele'))
                                            <span class="custom-control-description text-danger">
                                                {{ $errors->first('modele')}}
                                            </span>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <script>
                            function showCustomer(str) {
                                var xhttp;
                                if (str == "") {
                                    document.getElementById("txtHint").innerHTML = "";
                                    return;
                                }
                                xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById("txtHint").innerHTML = this.responseText;
                                    }
                                };
                                    xhttp.open("GET", "automobile.getModelesMarques?q="+str, true);
                                    xhttp.send();
                                }
                        </script>




                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Couleur</label>
                                    <select name="couleur" class="form-control" >
                                        @foreach ($couleurs as $item)
                                            <option value="{{$item->nom}}">{{$item->nom}}</option>
                                        @endforeach
                                        @if ($errors->has('couleur'))
                                            <span class="custom-control-description text-danger">
                                                {{ $errors->first('couleur')}}
                                            </span>
                                        @endif
                                    </select>
                                 </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Annee de sortie</label>
                                    <input type="text" class="form-control yearpicker" name="sortie" value="{{ old('sortie') }}" >
                                    @if ($errors->has('sortie'))
                                        <span class="custom-control-description text-danger">
                                            {{ $errors->first('sortie')}}
                                        </span>
                                    @endif
                                    @if (session('sortie'))
                                        <span class="custom-control-description text-danger">
                                            {{ session('sortie') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                  <label for="">Priorité</label>
                                  <select class="form-control" name="priorite">
                                    <option>Sélectionnez la priorité d'affichage</option>
                                    <option value="0">Dans Achat</option>
                                    <option value="1">Dans accueil</option>
                                  </select>
                                    @if ($errors->has('priorite'))
                                        <span class="custom-control-description text-danger">
                                            {{ $errors->first('priorite')}}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Prix CFA</label>
                                    <input type="text" class="form-control" name="prix"  placeholder="Prix CFA" value="{{ old('prix') }}">
                                    @if ($errors->has('prix'))
                                        <span class="custom-control-description text-danger">
                                            {{ $errors->first('prix')}}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" class="form-control-file" name="photo" aria-describedby="fileHelpId">
                                    @if ($errors->has('photo'))
                                        <span class="custom-control-description text-danger">
                                            {{ $errors->first('photo')}}
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
<script>
    function loadModeleMarque() {
        document.getElementById("demo").innerHTML = "Paragraph changed!";
    }
</script>
@endsection
