@extends('layouts/app')
@section('title')
    tickets
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('css/ticket.css')}}">
    @foreach($tickets as $ticket)
        <div class="ticket-container">
            <div class="ticket-right">
                <div class="ticket-image">
                    <img src="{{$ticket->url}}">
                </div>
                <div class="ticket-exept-img">
                    <div class="ticket-movie">
                        {{$ticket->title}}
                    </div>
                    <div class="ticket-number">
                         Квиток ID : {{$ticket->id }}
                    </div>

                    <div class="ticket-hall">
                         {{$ticket->hall}}
                    </div>
                    <div class="ticket-date">
                         {{$ticket->date}}
                    </div>
                    <div class="ticket-time">
                         {{substr($ticket->time, 0, 5)}}
                    </div>
                    <div class="ticket-price">
                        Ціна :{{$ticket->price}}
                    </div>
                </div>
            </div>
            <div class="ticket-left">
                <div class="delete-reservation">
                     del
                </div>
            </div>
        </div>
    @endforeach

@endsection
