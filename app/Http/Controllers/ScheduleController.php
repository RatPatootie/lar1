<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Movies;
use App\Models\Seat;
use App\Models\Session;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function showSchedule()
    {
        $sessions = Session::join('movies', 'sessions.movie_id', '=', 'movies.id')
            ->join('halls', 'sessions.hall_number', '=', 'halls.id')
            ->select('sessions.*', 'movies.title as title', 'movies.poster_url', 'halls.description as hall_description')
            ->where('sessions.date_of_session',">=",Carbon::today())
            ->get();

        return view('schedule', ['sessions' => $sessions]);
    }
    public function showSchedulePost(Request $request, )
    {
        $seatsData = $request->json()->all();
        DB::transaction(function () use ($seatsData) {
            foreach ($seatsData as $seatData) {
                $existingSeat = Seat::where('row', $seatData['row'])
                    ->where('seat', $seatData['seat'])
                    ->where('session_id',$seatData['session_id'])
                    ->exists();

                if (!$existingSeat) {
                    $user = Auth::user();
                    $ticket =Ticket::create([
                        'session_id'=> $seatData['session_id'],
                        'user_id'=>$user->id,
                        'price'=>50
                    ]);
                    Seat::create([
                        'row' => $seatData['row'],
                        'seat' => $seatData['seat'],
                        'session_id'=>$seatData['session_id'],
                        'ticket_id'=>$ticket->id,
                        'is_booked'=> 1
                    ]);
                }
            }
        });
        return redirect()->back();
    }

    public function showMovie($session)
    {
        $sessionExists = Session::where('id', $session)->exists();

        if (!$sessionExists) {
            // Handle the case when session does not exist, for example:
            // Redirect to an error page or return a response with an error message
            return redirect()->route('schedule')->with('error', 'Session does not exist.');
        }
        $bookedSeats = Seat::where('session_id', $session)->get();

        $seats = Hall::join('sessions', 'halls.id', '=', 'sessions.hall_number')
            ->join('movies', 'sessions.movie_id', '=', 'movies.id')
            ->where('sessions.id', '=', $session)
            ->select('halls.description as description', 'halls.row as rows', 'halls.seat as seats', 'sessions.start_time as time','movies.title as title','movies.poster_url as poster_url')
            ->get();

        return view('movies.hall', ['seats' => $seats, 'bookedSeats' => $bookedSeats,'session'=>$session]);
    }

}
