<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\select;

class TicketController extends Controller
{
    public function showTickets(){
        /*
        $user = Auth::user();
        $tickets=Ticket::join('sessions', 'tickets.session_id', '=', 'sessions.id')
            ->join('movies', 'sessions.movie_id', '=', 'movies.id')
            ->join('seats','tickets.id','=','seats.ticket_id')
            ->select('sessions.id as id','movies.title','start_time','ticket_id','row','seat')
            ->where('user_id',$user->id)
            ->get();*/
        $user = Auth::user();
        $tickets=Ticket::join('sessions', 'tickets.session_id', '=', 'sessions.id')
            ->join('movies', 'sessions.movie_id', '=', 'movies.id')
            ->join('seats','tickets.id','=','seats.ticket_id')
            ->select()
            ->where('user_id',$user->id)
            ->get();

        return $tickets;//view('movies.tickets' ,['tickets'=>$tickets]);
}
}
