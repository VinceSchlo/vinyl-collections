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
    <h1>Ajouter un nouveau genre</h1>
    <div class="row">
    <form method="post" action="{{ route('genres.store') }}">
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