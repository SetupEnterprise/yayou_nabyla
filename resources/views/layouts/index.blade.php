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
              <h3 class="mb-0">Total Automobiles</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                 
                  <tr>
                    <th scope="col">Marque et Version</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Annee de sortie</th>
                    <th scope="col">Priorite</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($automobiles as $auto)
                      
                  
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mr-3">
                          <img alt="Image placeholder" src="{{asset('image_auto/06072020134210.JPG')}}">
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
                      <div class="d-flex align-items-center">
                      <span class="mr-2">{{$auto->priorite}}%</span>
                        <div>
                          <div class="progress">
                            @if ($auto->priorite<25)
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="{{$auto->priorite}}" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            @elseif  (($auto->priorite>25) && ($auto->priorite<70))
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{$auto->priorite}}" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            @elseif  ($auto->priorite>70)
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{$auto->priorite}}" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            @endif
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" style="background-color: #eaecf4" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="{{route('automobile.edit', $auto->id)}}">Modifier</a>
                          <form action="{{ route('automobile.destroy', $auto->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez vous supprimer ce automobile')">
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
