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
        <form method="post" action="{{ route('vinyls.update', ['$vinyl' => $vinyl->id]) }}">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">Titre</label>
                <input type="text" class="form-control" name="name" value="{{ $vinyl->name }}"/>
            </div>
            <div class="form-group">
                <label for="date">Date de sortie</label>
                <input type="date" class="form-control" name="date" value="{{ $vinyl->date }}"/>
            </div>
            <div class="form-group">
                <label for="tracklist">Tracklist</label>
                <input type="text" class="form-control" name="tracklist" value="{{ $vinyl->tracklist }}"/>
            </div>
            <div class="form-group">  
                <input type="radio" name="format" value="33" {{ ( $vinyl->format == '33' ) ? 'checked' : '' }} ><label for="format">33T</label>
                <input type="radio" name="format" value="45" {{ ( $vinyl->format == '45' ) ? 'checked' : '' }}><label for="format">45T</label>
            </div>
            <div class="form-group">  
                <select name="artist_id" id="artist_id">
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->id }}" {{ ( $artist->name == $vinyl->artist->name ) ? 'selected' : '' }}>{{ $artist->name }}</option> 
                    @endforeach
                </select>
            </div>
            <div class="form-group">  
                <select name="genre_id" id="genre_id">
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ ( $genre->name == $vinyl->genre->name ) ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">  
                <select name="pochette-id" id="pochette">
                    @foreach ($pochettes as $pochette)
                        <option value="{{ $pochette->id }}" {{ ( $pochette->id == $vinyl->pochette->id ) ? 'selected' : '' }}>{{ $pochette->illustrator }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection