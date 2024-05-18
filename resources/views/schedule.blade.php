@extends('layouts/app')
@section('title')
    Розклад
@endsection
@section('content')
    <style>
        .movie-content{
            margin: 10px 150px;
            display: flex;
            border: 3px solid transparent;
            background-color: rgba(40, 64, 56, 0.09);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(88, 200, 163, 0.12);
        }
        .tittle{
            padding: 10px;
        }
        .movie-link{
            background-color: rgba(27, 215, 154, 0.56);
            padding: 2px;
            border:solid 3px transparent;
            border-radius: 4px
        }
        .hall1{
            margin: 10px 0 20px 10px;
        }
        .hall2{
            margin-left: 10px;
        }
        @media (max-width: 664px) {
            .movie-content{
                margin: 2vw;
                flex-direction: column;

            }
            .poster,.poster img{
                width: 96vw;


            }
            .poster{
                margin: 0 auto;
            }
        }
    </style>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @php
    if(!empty($sessions)){
        $sessionsByTitle = $sessions->groupBy('title'); // Групуємо сесії за назвою фільму
    }
    @endphp

    @foreach($sessionsByTitle as $title => $sessions)
        <div class="movie-content">

            <div class="poster">
                <img src="{{ $sessions->first()->poster_url }}" alt="{{ $title }}" width="200px">
            </div>
            <div class="right-sch">
                <div class="tittle">
                    <h3>{{ $title }}</h3>
                </div>
                <div class="hall1">
                Hall1:
                @foreach($sessions as $session)
                    @if($session->hall_description=='hall1')

                    <a href="{{ route('hall', ['session' => $session->id]) }}" class="movie-link" title="{{ $session->hall_description }}">  {{ substr($session->start_time, 0, 5) }}</a>
                    @endif
                @endforeach
                </div>
                <div class="hall2">
                    Hall2:
                    @foreach($sessions as $session)
                        @if($session->hall_description=='hall2')

                            <a href="{{ route('hall', ['session' => $session->id]) }}" class="movie-link" title="{{ $session->hall_description }}">  {{ substr($session->start_time, 0, 5) }}</a>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    @endforeach


@endsection
