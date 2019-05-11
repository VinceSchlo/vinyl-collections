@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>Tous les vinyles</h2>
        <a href="{{ route('vinyls.create') }}" class="btn btn-primary">Ajouter Vinyle</a>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                <td>ID</td>
                <td>Nom</td>
                <td>Date</td>
                <td>Format</td>
                <td>Tracklist</td>
                <td>Artiste</td>
                <td>Genre</td>
                <!-- <td>Genre</td> -->
                <td colspan="3">Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($vinyls as $vinyl)
                <tr>
                    <td>{{ $vinyl->id }}</td>
                    <td>{{ $vinyl->name }}</td>
                    <td>{{ $vinyl->date }}</td>
                    <td>{{ $vinyl->format }}</td>
                    <td>{{ $vinyl->tracklist }}</td>
                    <td>{{ $vinyl->artist->name }}</td>
                    <td>{{ $vinyl->genre->name }}</td>
                    <td><a href="{{ route('vinyls.edit', ['vinyl' => $vinyl->id] ) }}" class="btn btn-warning">Edit</a></td>
                    <td>
                        <form action="{{ route('vinyls.destroy', ['vinyl' => $vinyl->id]) }} " method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                    <td><a href="{{ route('vinyls.show', ['vinyl' => $vinyl->id] ) }}" class="btn btn-success">Show</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

