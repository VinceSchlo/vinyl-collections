@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h2>Artistes</h2>
        </div>
        <div class="row">
            <a href="{{ route('artists.create') }}" class="btn btn-success">Ajouter Artiste</a>
            <a href="{{ route('artists.index') }}" class="btn btn-default">Tous les Artistes</a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h2>Genres</h2>
        </div>
        <div class="row">
            <a href="{{ route('genres.create') }}" class="btn btn-success">Ajouter Genre</a>
            <a href="{{ route('genres.index') }}" class="btn btn-default">Tous les Genres</a>
        </div>
    </div>
</div>
</div>
@endsection
