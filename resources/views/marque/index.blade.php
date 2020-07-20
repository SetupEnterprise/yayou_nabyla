@extends('master_gerant', ['title' => 'Automobiles-Marques'])

@section('head')
    <link href="{{ asset('css/formulaire.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('contenu_page')

<!-- Content Row -->
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
          <div class="card shadow">
            <div class="card-header border-0">
            <a class="btn btn-primary" href="{{route('marque.create')}}">Nouvelle Marque</a>
            </div>

            <div class="table-responsive">
                @if ($taille > 0)
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">

                            <tr>
                            <th scope="col">Logo</th>
                            <th scope="col">Marque</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marques as $marque)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                        <a href="#" class="avatar rounded-circle mr-3">
                                            <img class="avatar rounded-circle" alt="Image placeholder" src="logo_marque/{{$marque->logo}}"/>
                                        </a>
                                        </div>
                                    </th>

                                    <td>
                                        <span class="mb-0 text-sm font-weight-bold">{{$marque->nom_marque}}</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light bg-primary"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{route('marque.edit', $marque->id)}}">Modifier</a>
                                            <form action="{{ route('marque.destroy', $marque->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez vous supprimer ce automobile')">
                                                {{csrf_field() }}
                                                {{ method_field('DELETE')}}
                                                <input type="submit" class="dropdown-item" name="Supprimer" value="Supprimer">
                                            </form>

                                            </div>
                                        </div>
                                        </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">Aucune marque n'est encore enregistrée</h3>
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
