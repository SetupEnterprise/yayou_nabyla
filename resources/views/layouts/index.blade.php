@extends('master_gerant', ['title' => 'Automobiles'])

@section('head')
    <link href="{{ asset('css/formulaire.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('contenu_page')

<!-- Content Row -->
    <div class="row">
        <div class="col-md-0.5"></div>
        <div class="col-md-12">
            @if (session()->has('erreur_extension'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('erreur_extension')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif
          <div class="card shadow">
            <div class="card-header border-0">
                <h3 class="mb-0">Total Automobile(s) {{ $taille }}</h3>
                <a class="btn btn-primary" href="{{route('automobile.create')}}">Nouvel automobile</a>
            </div>
            <div class="table-responsive">
                @if ($taille > 0)
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">

                            <tr>
                                <th scope="col">Marque et Version</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Etat</th>
                                <th scope="col">Annee de sortie</th>
                                <th scope="col">Afficher dans</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($automobiles as $auto)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                        <a href="#" class="avatar rounded-circle mr-3">
                                            <img alt="Image placeholder" src="image_auto/{{ $auto->photo_profil }}">
                                        </a>
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">{{$auto->nom_marque}} {{$auto->version}}</span>
                                        </div>
                                        </div>
                                    </th>
                                    <td>
                                        {{$auto->prix}}
                                    </td>
                                    <td>
                                        <span class="badge badge-dot mr-4">
                                        @if ($auto->estVendu)
                                        <i class="bg-success"></i> vendu
                                        @else
                                        <i class="bg-danger"></i> pas vendu
                                        @endif

                                        </span>
                                    </td>
                                    <td>
                                        <div class="media-body">
                                        <span class="text-sm">{{$auto->annee_sortie}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($auto->priorite == 1)
                                            <span class="text-sm">Accueil</span>
                                        @else
                                            <span class="text-sm">Achat</span>
                                        @endif

                                    </td>

                                    <td>
                                        <a href="#" class="btn btn-sm btn-success text-white"
                                            data-toggle="tooltip" data-placement="top" title="Cliquez pour voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td class="text-right">
                                        <!-- Default dropup button -->
                                        <a class="btn btn-primary text-white" data-toggle="modal" data-target="#staticBackdrop">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </a>
                                        <div class="btn-group dropup">
                                            <button type="button" class="btn btn-primary">
                                                actions
                                            </button>
                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- Dropdown menu links -->
                                                <a class="dropdown-item" href="#">Ajouter plus d'images</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- Modal ici --}}
                                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">{{$auto->nom_marque}} {{$auto->version}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('images') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                          <input type="hidden" class="form-control" name="automobile_id" value="{{ $auto->automobile_id }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <i class="fas fa-images"></i>
                                                            <label for="exampleFormControlFile1">Ajouter un ou plusieurs images</label>
                                                            <input type="file" class="form-control-file" name="images[]" multiple id="exampleFormControlFile1">
                                                            @if ($errors->has('images'))
                                                                <span class="custom-control-description text-danger">
                                                                    {{ $errors->first('images')}}
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal" >Fermer</button>
                                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">Aucun automobile n'est encore enregistré</h3>
                @endif
        </div>
            @if ($taille > 0)
                <div class="card-footer py-4">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-end mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">
                            <i class="fas fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                            <i class="fas fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                            </a>
                        </li>
                        </ul>
                    </nav>
                </div>
            @else
            @endif
          </div>
        </div>
    </div>

@endsection
