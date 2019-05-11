@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un nouvel artiste</h1>
    <div class="row">
    <form method="post" action="{{ route('artists.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>
@endsection