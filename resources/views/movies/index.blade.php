@extends('layouts/app')
@section('title')
    Фільми
@endsection
@section('content')

<style>

</style>
<div class="posters" style="display: grid;grid-gap: 0 4%;grid-template-columns: repeat(auto-fit, minmax(218px, 1fr));grid-template-rows: auto;">
    @foreach($movies as $movie)
        <div class="poster-box">
        <h2>{{$movie->title}}</h2>

            <a href="{{route('movie.info',['movie'=>$movie->id])}}"><img src="{{ $movie->poster_url }}" alt="{{ $movie->title }} Poster" style="width: 200px;"></a>
        </div>
            @endforeach
</div>
@endsection
