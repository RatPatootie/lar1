@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title')
    {{$seats->first()->title}}
    {{$seats->first()->description}}

@endsection

    @section('content')
        <style>

        .seats {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            margin-left: 5rem;
        }

        .row {
            display: flex;
            margin-bottom: 10px; /* відступ між рядками */
        }

        .seat {
            width: 30px; /* ширина місця */
            height: 30px; /* висота місця */
            margin-right: 5px; /* відступ між місцями */
            display: flex;
            justify-content: center;
            align-items: center;
            border: 3px solid #1bd79a;
            border-radius: 3px;
            color: #fff;
        }
        .seat:hover{
            background-color: rgba(27, 215, 154, 0.8);
        }
        .booked:hover{
            background-color: #1bd79a;
            color: #1bd79a;
        }
        .booked{
            background-color: #1bd79a;
            color: #1bd79a;
        }
        .selected{
            background-color: #1bd79a;
        }
        .screen{
            text-transform: uppercase;

            display: inline-block;

        }
        .caption{
            color:#a1a1a1;
            text-align: center;
            background-color: #fff;
            padding: 0 6px;
            height: 14px;
            margin: 5px;
        }
        .seats-container{
            display: flex;
            justify-content: space-around;
        }
        .hall-poster{
            display: inline-block;
            float: left;
        }
        .hall-description{

            margin-left:10px ;

            display: inline-block;
            float: left;
            font-family: "Inconsolata", "Fira Mono", "Source Code Pro", Monaco, Consolas, "Lucida Console", monospace;
            font-size: 17px;
        }
        .hall-description p{
            color:#666666;
            margin: 10px;
            margin-left: 0px;
        }
        .seats-container div {

        }
        .movie-info{
            display: flex;
            flex-direction:column;
            min-width: 240px;
            padding: 50px 5% 30px 0;
            font-family: 'Open Sans', sans-serif;
        }
        .seats{
            padding-top: 50px;
        }
        #booked-btn{
            background-color: #1bd79a;
            padding:10px 20px;
            border: 3px solid transparent;
            border-radius: 10px;
            font-size: 16px;
            color:white;
        }
        .selected-seat-info{
            background-color: rgba(76, 191, 122, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px;
            border: 3px solid transparent;
            box-shadow:0 0 10px rgba(49,181,116,0.44) ;
        }
        .right-ticket{
            display: flex;
            text-align: center;
        }
        .price{
            font-size: 12px;
            margin: 10px;
        }
        .info{
            font-size: 20px;
            margin: 10px;
        }
        .price-info{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #max_4{
            color:red;
        }
        @media (max-width: 664px) {
          .seats-container{
              flex-direction: column;

          }
          .seats{
              margin-left: 5px;
          }
          .seat{
              height: 20px;
              width: 20px;
          }
          .movie-info{
              padding: 0;
          }
          .hall-poster{
              margin-left: 5px;
              box-shadow: 0 0 5px black;
          }
          .row-container{
              margin: 0 auto;
          }
        }
    </style>

        <br>
        <div class="seats-container">
            <div class="movie-info">
                <div id="hall-header">
                    <div class="hall-poster">
                        <img src="../{{ $seats->first()->poster_url }}" alt="{{ $seats->first()->title }}" width="150px">
                    </div>
                    <div class="hall-description">
                        <h3>{{$seats->first()->title}}</h3>
                        <p>Start time: {{ substr($seats->first()->time, 0, 5) }} </p>
                        <p>Hall: {{$seats->first()->description}}</p>
                    </div>
                </div>
                <br>
                <div id="tickets"></div>
                <button onclick="sendSelectedSeats()" id="booked-btn">Забронювати </button>
            </div>
            <div class="seats">

                <div class="screen">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 806 21" fill="#061420">
                        <path d="M3.2,20l-2,0.2l-0.3-4l2-0.2C136.2,5.3,269.6,0,403,0s266.8,5.3,400.2,16l2,0.2l-0.3,4l-2-0.2 C669.5,9.3,536.3,4,403,4S136.4,9.3,3.2,20z"></path>
                    </svg>
                    <div class="caption">
                        екран
                    </div>
                </div>
                <br>
                @php
                    $firstSeat = $seats->first();
                    $bookedSeatsMap = [];
                    if(!empty($bookedSeats)){
                    foreach ($bookedSeats as $booked) {
                        $bookedSeatsMap[$booked->row][$booked->seat] = true;
                    }}
                @endphp
                <div class="row-container">
                @for($i = 1; $i <= $firstSeat->rows; $i++)
                    <div class="row">
                        <div class="row-number" style="width: 50px;height:30px;display: flex;align-items: center">{{$i}} Ряд</div>
                        @for($j = 1; $j <= $firstSeat->seats; $j++)
                            <div class="seat {{ isset($bookedSeatsMap[$i][$j]) ? ' booked' : 'selectable' }}" data-row="{{ $i }}" data-seat="{{ $j }}">{{ $j }}</div>
                        @endfor
                    </div>
                @endfor
                </div>
            </div>

        </div>


        <script>
            var sessionId={{$session}}
        </script>
        <script src="{{asset('js/hall.js')}}"></script>





    @endsection
