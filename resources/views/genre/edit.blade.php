@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
    <div class="row">
    <form method="post" action="{{ route('genres.update', ['genre' => $genre->id] ) }}" >
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" name="name" value="{{ $genre->name }}" />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection