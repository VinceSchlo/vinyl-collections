@extends('layouts.app')

@section('content')
<div class="container">
    <div id="app">
        <artist-show/>
    </div>
    <div class="row">
        <h1>{{ $artist->name }}</h1>
    </div>
</div>
@endsection