@extends('layouts/app')
@section('title')
    {{$movie->first()->title}}
@endsection
@section('content')
    {{$movie->first()->title}}
    <div>
        <img src="../{{$movie->first()->poster_url }}" alt="{{ $movie->first()->title }}" width="200px">
    </div>
    @foreach($sessions as $session)
        <a href="{{ route('hall', ['session' => $session->id]) }}"style="background-color: #4ca585;border:solid 3px white;border-radius: 5px"title="{{ $session->hall }}">  {{ substr($session->start_time, 0, 5) }}</a>
    @endforeach


@endsection
