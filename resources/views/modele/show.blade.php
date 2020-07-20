@extends('master_gerant', ['title' => 'Voir un modèle'])

@section('contenu_page')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            @foreach ($modele as $item)
                <h3>{{ $item->version }}</h3>
                <p>
                    {{ $item->description }}
                </p>
            @endforeach
        </div>
    </div>
@endsection
