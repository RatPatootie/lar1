<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Cassandra\Date;
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
            ->join('halls','sessions.hall_number','=','halls.id')
            ->select(
                'movies.poster_url as url',
                'tickets.id as id',
                'movies.title as title',
                'halls.description as hall',
                'sessions.date_of_session as date',
                'sessions.start_time as time',
                'tickets.price as price')
            ->where('user_id',$user->id)
            ->where('sessions.date_of_session','>=',Carbon::today())
            ->get();

        return view('movies.tickets' ,['tickets'=>$tickets]);
}
}
