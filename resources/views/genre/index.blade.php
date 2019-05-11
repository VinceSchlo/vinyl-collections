@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>Tous les genres</h2>
        <a href="{{ route('genres.create') }}" class="btn btn-primary">Ajouter Genre</a>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                <td>ID</td>
                <td>Nom</td>
                <td colspan="3">Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($genres as $genre)
                <tr>
                    <td>{{$genre->id}}</td>
                    <td>{{$genre->name}}</td>
                    <td><a href="{{ route('genres.edit', ['genre' => $genre->id] ) }}" class="btn btn-warning">Edit</a></td>
                    <td>
                        <form action="{{ route('genres.destroy', ['genre' => $genre->id]) }} " method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                    <td><a href="{{ route('genres.show', ['genre' => $genre->id] ) }}" class="btn btn-success">Show</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

