@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>{{ $vinyl->name }}</h1>
        <ul>
            <li>{{ $vinyl->format }}</li>
            <li>{{ $vinyl->artist->name }}</li>
            <li>{{ $vinyl->date }}</li>
            <li>{{ $vinyl->tracklist }}</li>
            <li>{{ $vinyl->genre->name }}</li>
        </ul>
    </div>
</div>
@endsection