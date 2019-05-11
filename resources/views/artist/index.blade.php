@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>Tous un nouvel artiste</h2>
        <a href="{{ route('artists.create') }}" class="btn btn-primary">Ajouter Artiste</a>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                <td>ID</td>
                <td>Nom</td>
                <td colspan="2">Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($artists as $artist)
                <tr>
                    <td>{{$artist->id}}</td>
                    <td>{{$artist->name}}</td>
                    <td><a href="{{ route('artists.edit', ['artist' => $artist->id] ) }}" class="btn btn-warning">Edit</a></td>
                    <td>
                        <form action="{{ route('artists.destroy', ['artist' => $artist->id]) }} " method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

