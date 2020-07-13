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
                <a class="btn btn-primary" href="{{route('modele.create')}}">Nouveau modèl</a>
            </div>

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">

                  <tr>
                    <th scope="col">Logo</th>
                    <th scope="col">Marque</th>
                    <th scope="col">Modèl</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($modeles as $modele)


                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mr-3">
                            <img alt="Image placeholder" src="logo_marque/{{$modele->logo}}"/>
                        </a>
                      </div>
                    </th>

                    <td>
                        <span class="mb-0 text-sm font-weight-bold">{{$modele->nom_marque}}</span>
                    </td>

                    <td>
                        <span class="mb-0 text-sm font-weight-bold">{{$modele->version}}</span>
                    </td>
                    <td class="text-right">
                        <div class="dropdown">
                          <a class="btn btn-sm btn-icon-only text-light bg-primary"  href="#" data-toggle="modal" data-target="#staticBackdrop">
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal" href="#">Voir la description</a>
                            <a class="dropdown-item" href="{{route('modele.edit', $modele->modele_id)}}">Modifier</a>
                            <form action="{{ route('modele.destroy', $modele->modele_id) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez vous supprimer ce automobile')">
                              {{csrf_field() }}
                              {{ method_field('DELETE')}}
                              <input type="submit" class="dropdown-item" name="Supprimer" value="Supprimer">
                            </form>

                          </div>
                        </div>
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">{{$modele->nom_marque}} - {{$modele->version}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{$modele->description}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" >Fermer</button>
                            </div>
                            </div>
                        </div>
                    </div>




                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
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
          </div>
        </div>
        </div>
@endsection
