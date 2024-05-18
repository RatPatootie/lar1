@extends('layouts/app')
@section('title')
    tickets
@endsection
@section('content')

    @foreach($tickets as $ticket)
        N квитка{{$ticket->id }}
        Сесія {{$ticket->session_id}}
        Користувач{{$ticket->user_id}}
<br>
    @endforeach

@endsection
