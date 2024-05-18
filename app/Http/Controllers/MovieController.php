<?php

namespace App\Http\Controllers;


use App\Models\Movies;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movies::all();
        return view('movies.index', compact('movies'));
    }
    public function info($movie){
        $movieInfo=Movies::all()
            ->where('id',$movie);
        $sessions= Movies::join('sessions', 'movies.id', '=', 'sessions.movie_id')
            ->where('movies.id', $movie)
            ->where('date_of_session', '<=', Carbon::today())
            ->select('sessions.id as id','sessions.start_time as start_time','sessions.hall_number as hall')
            ->get();
        return  view('movies.movie_info',['movie'=>$movieInfo,'sessions'=>$sessions]);
    }

}
