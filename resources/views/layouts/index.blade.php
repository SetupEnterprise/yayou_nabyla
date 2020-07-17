@extends('master_gerant', ['title' => 'Automobiles'])

@section('head')
    <link href="{{ asset('css/formulaire.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('contenu_page')

<!-- Content Row -->
    <div class="row">
        <div class="col-md-0.5"></div>
        <div class="col-md-12">
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
                                    <td class="text-right">
                                        <!-- Default dropup button -->
                                        <div class="btn-group dropup">
                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Dropup
                                        </button>
                                        <div class="dropdown-menu">
                                            <!-- Dropdown menu links -->
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                        </div>
                                        {{-- <div class="dropdown">
                                            <a
                                                class="btn btn-sm btn-icon-only text-light bg-primary dropdown-toggle"
                                                href="#" role="button" data-toggle="dropdown" id="dropdownMenuLink"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="{{route('automobile.edit', $auto->id)}}">Modifier</a>
                                                <form action="{{ route('automobile.destroy', $auto->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez vous supprimer ce automobile')">
                                                    {{csrf_field() }}
                                                    {{ method_field('DELETE')}}
                                                    <input type="submit" class="dropdown-item" name="Supprimer" value="Supprimer">
                                                </form>
                                            </div>
                                        </div> --}}
                                    </td>
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
