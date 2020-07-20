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
                <a class="btn btn-primary" href="{{route('modele.create')}}">Nouveau modèle</a>
            </div>

            <div class="table-responsive">
                @if ($taille > 0)

                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Logo</th>
                                <th scope="col">Marque</th>
                                <th scope="col">Modèl</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modeles as $modele)
                              <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                      <a href="#" class="avatar rounded-circle mr-3">
                                          <img class="avatar rounded-circle" alt="Image" src="logo_marque/{{$modele->logo}}"/>
                                      </a>
                                    </div>
                                </th>

                                <td>
                                  <span class="mb-0 text-sm font-weight-bold text-center">{{$modele->nom_marque}}</span>
                                </td>

                                <td>
                                  <span class="mb-0 text-sm font-weight-bold text-center">{{$modele->version}}</span>
                                </td>

                                <td>
                                    <a href="{{ route('modele.show', $modele->modele_id) }}" class="btn btn-sm btn-icon-only bg-success text-white"
                                        data-toggle="tooltip" data-placement="top" title="Cliquez pour voir">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>


                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only bg-primary text-white"
                                            href="#" data-toggle="modal"
                                            data-target="#staticBackdrop{{$modele->modele_id}}"
                                            data-toggle="tooltip" data-placement="top" title="Cliquez pour modifier">
                                            <i class="fa fa-pen "></i>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('modele.destroy', $modele->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez vous supprimer ce modele ?')">
                                        {{csrf_field() }}
                                        {{ method_field('DELETE')}}
                                        <button
                                            type="submit" class="btn btn-sm btn-icon-only bg-danger text-white"
                                            data-toggle="tooltip" data-placement="top" title="Cliquez pour supprimer">
                                            <i class="fa fa-trash" aria-hidden="true"></i>

                                        </button>
                                    </form>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop{{$modele->modele_id}}" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">{{$modele->nom_marque}} - {{$modele->version}}</h5><br>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('modele.update', $modele->modele_id) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez vous modifier ce modèle?')">
                                        <div class="modal-body">
                                                {{csrf_field() }}
                                                {{method_field('PUT')}}
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="marque" value="{{$modele->nom_marque}}" disabled required>
                                                </div>
                                                <div class="form-group">
                                                <input type="text" class="form-control" name="version" value="{{$modele->version}}">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" required name="description">{{$modele->description}}</textarea>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal" >Annuler</button>
                                            <input type="submit" class="btn btn-primary" name="" value="modifier">
                                        </div>
                                    </form>

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
